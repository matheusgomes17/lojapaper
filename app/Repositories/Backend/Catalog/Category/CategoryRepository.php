<?php

namespace Snaketec\Repositories\Backend\Catalog\Category;

use Kalnoy\Nestedset\Collection;
use Snaketec\Events\Backend\Catalog\Category\CategoryCreated;
use Snaketec\Events\Backend\Catalog\Category\CategoryDeleted;
use Snaketec\Events\Backend\Catalog\Category\CategoryUpdated;
use Snaketec\Models\Catalog\Category\Category;
use Snaketec\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use Snaketec\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryRepository.
 */
class CategoryRepository extends Repository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Category::class;

    /**
     * @param string $order_by
     * @param string $sort
     *
     * @return mixed
     */
    public function getForDataTable($order_by = 'sort', $sort = 'asc')
    {
        return $this->query()
            ->orderBy($order_by, $sort)
            ->select([
                config('catalog.categories_table').'.id',
                config('catalog.categories_table').'.name',
                config('catalog.categories_table').'.created_at',
                config('catalog.categories_table').'.updated_at',
            ]);
    }

    /**
     * @param Model $input
     */
    public function create($input)
    {
        $data = $input['data'];
        $category = $this->createCategoryStub($data);

        DB::transaction(function () use ($category) {
            if (parent::save($category)) {

                event(new CategoryCreated($category));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.catalog.categories.create_error'));
        });
    }

    /**
     * @param Model $category
     * @param array $input
     * @return Model
     */
    public function update(Model $category, array $input)
    {
        $data = $input['data'];

        DB::transaction(function () use ($category, $data) {
            if (parent::update($category, $data)) {

                parent::save($category);

                event(new CategoryUpdated($category));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.catalog.categories.update_error'));
        });
    }

    /**
     * @param Model $category
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Model $category)
    {
        if (parent::delete($category)) {
            event(new CategoryDeleted($category));

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.catalog.categories.delete_error'));
    }

    /**
     * @param  $except
     * @return Category
     */
    public function getCategoryOptions($except = null) {
        /** @var \Kalnoy\Nestedset\QueryBuilder $query */
        $query = Category::select('id', 'name')->withDepth();
        if ($except) {
            $query->whereNotDescendantOf($except)->where('id', '<>', $except->id);
        }
        return $this->makeOptions($query->get());
    }

    /**
     * @param Collection $items
     * @return static
     */
    protected function makeOptions(Collection $items) {
        $options = ['' => trans('exceptions.backend.catalog.categories.main')];
        foreach ($items as $item) {
            $options[$item->getKey()] = str_repeat('-', $item->depth + 1).' '.$item->name;
        }
        return $options;
    }

    /**
     * @param  $input
     *
     * @return mixed
     */
    protected function createCategoryStub($input)
    {
        $category = self::MODEL;
        $category = new $category();
        $category->name = $input['name'];
        $category->description = $input['description'];
        $category->user_id = auth()->user()->id;

        return $category;
    }
}
