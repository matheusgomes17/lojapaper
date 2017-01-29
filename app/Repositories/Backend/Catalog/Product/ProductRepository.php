<?php

namespace Snaketec\Repositories\Backend\Catalog\Product;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\Collection;
use Snaketec\Events\Backend\Catalog\Product\ProductCreated;
use Snaketec\Events\Backend\Catalog\Product\ProductDeactivated;
use Snaketec\Events\Backend\Catalog\Product\ProductDeleted;
use Snaketec\Events\Backend\Catalog\Product\ProductPermanentlyDeleted;
use Snaketec\Events\Backend\Catalog\Product\ProductReactivated;
use Snaketec\Events\Backend\Catalog\Product\ProductRestored;
use Snaketec\Events\Backend\Catalog\Product\ProductUpdated;
use Snaketec\Models\Catalog\Category\Category;
use Snaketec\Models\Catalog\Product\Product;
use Snaketec\Repositories\Backend\Catalog\Category\CategoryRepository;
use Snaketec\Repositories\Repository;
use Snaketec\Exceptions\GeneralException;

/**
 * Class ProductRepository.
 */
class ProductRepository extends Repository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Product::class;

    /**
     * @var CategoryRepository
     */
    protected $category;

    /**
     * @param CategoryRepository $category
     */
    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    /**
     * @param int  $status
     * @param bool $trashed
     *
     * @return mixed
     */
    public function getForDataTable($status = 1, $trashed = false)
    {
        /**
         * Note: You must return deleted_at or the Product getActionButtonsAttribute won't
         * be able to differentiate what buttons to show for each row.
         */
        $dataTableQuery = $this->query()
            ->with('categories')
            ->select([
                config('catalog.products_table').'.id',
                config('catalog.products_table').'.name',
                config('catalog.products_table').'.code',
                config('catalog.products_table').'.category_id',
                config('catalog.products_table').'.status',
                config('catalog.products_table').'.created_at',
                config('catalog.products_table').'.updated_at',
                config('catalog.products_table').'.deleted_at',
            ]);

        if ($trashed == 'true') {
            return $dataTableQuery->onlyTrashed();
        }

        // active() is a scope on the ProductScope trait
        return $dataTableQuery->active($status);
    }

    /**
     * @param Model $input
     */
    public function create($input)
    {
        $data = $input['data'];
        $product = $this->createProductStub($data);
        $cover = $product['cover'];

        DB::transaction(function () use ($product, $cover) {
            $product['cover'] = $this->saveImage($cover);
            if (parent::save($product)) {

                event(new ProductCreated($product));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.catalog.products.create_error'));
        });
    }

    /**
     * @param Model $user
     * @param array $input
     */
    public function update(Model $user, array $input)
    {
        $data = $input['data'];
        $roles = $input['roles'];

        $this->checkUserByEmail($data, $user);

        DB::transaction(function () use ($user, $data, $roles) {
            if (parent::update($user, $data)) {
                //For whatever reason this just wont work in the above call, so a second is needed for now
                $user->status = isset($data['status']) ? 1 : 0;
                $user->confirmed = isset($data['confirmed']) ? 1 : 0;
                parent::save($user);

                $this->checkUserRolesCount($roles);
                $this->flushRoles($roles, $user);

                event(new ProductUpdated($user));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.catalog.products.update_error'));
        });
    }

    /**
     * @param Model $product
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Model $product)
    {
        if (parent::delete($product)) {
            event(new ProductDeleted($product));

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.catalog.products.delete_error'));
    }

    /**
     * @param Model $product
     * @throws GeneralException
     * @return bool
     */
    public function forceDelete(Model $product)
    {
        if (is_null($product->deleted_at)) {
            throw new GeneralException(trans('exceptions.backend.catalog.products.delete_first'));
        }

        DB::transaction(function () use ($product) {
            if (parent::forceDelete($product)) {
                //unlink(public_path($product['cover']));

                event(new ProductPermanentlyDeleted($product));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.catalog.products.delete_error'));
        });
    }

    /**
     * @param Model $product
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function restore(Model $product)
    {
        if (is_null($product->deleted_at)) {
            throw new GeneralException(trans('exceptions.backend.catalog.products.cant_restore'));
        }

        if (parent::restore(($product))) {
            event(new ProductRestored($product));

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.catalog.products.restore_error'));
    }

    /**
     * @param Model $product
     * @param $status
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function mark(Model $product, $status)
    {
        $product->status = $status;

        switch ($status) {
            case 0:
                event(new ProductDeactivated($product));
            break;

            case 1:
                event(new ProductReactivated($product));
            break;
        }

        if (parent::save($product)) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.catalog.products.mark_error'));
    }

    /**
     * @param $except
     * @return Category
     */
    public function getCategoryOptions($except = null)
    {
        /** @var \Kalnoy\Nestedset\QueryBuilder $query */
        $query = Category::select('id', 'name')->withDepth();
        if ($except) {
            $query->whereNotDescendantOf($except)->where('id', '<>', $except->id);
        }
        return $this->makeCategoryOptions($query->get());
    }

    /**
     * @param $image
     * @return string
     */
    private function saveImage($image)
    {
        $directory = 'uploads/images/'.date('Y/m').'/';
        $filename = uniqid(str_random(56));
        $ext = '.'.$image->getClientOriginalExtension();

        if(!file_exists($directory)){
            mkdir($directory, 0777, true);
        }

        \Image::make($image)->resize(250, 300)->save(public_path($directory.$filename.$ext));

        return $directory.$filename.$ext;
    }

    /**
     * @param  Collection $items
     * @return static
     */
    protected function makeCategoryOptions(Collection $items)
    {
        $options = ['' => trans('exceptions.backend.products.category_error')];
        if ($items->count() > 0) {
            foreach ($items as $item) {
                if ($item['attributes']['depth'] != 0) {
                    unset($options['']);
                    $options[$item->getKey()] = str_repeat('-', $item->depth) . ' ' . $item->name;
                }
            }
        }
        return $options;
    }

    /**
     * @param  $input
     *
     * @return mixed
     */
    protected function createProductStub($input)
    {
        $product                = self::MODEL;
        $product                = new $product();
        $product->name          = strtolower($input['name']);
        $product->cover         = $input['cover'];
        $product->code          = strtolower($input['code']);
        $product->category_id   = $input['category_id'];
        $product->description   = $input['description'];
        $product->status        = 1;
        $product->user_id       = auth()->id();

        return $product;
    }
}
