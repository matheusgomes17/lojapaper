<?php

namespace Snaketec\Http\Controllers\Backend\Catalog\Product;

use Snaketec\Http\Requests\Backend\Catalog\Product\ManageProductRequest;
use Snaketec\Http\Controllers\Controller;
use Snaketec\Models\Catalog\Product\Product;
use Snaketec\Repositories\Backend\Catalog\Product\ProductRepository;

/**
 * Class ProductStatusController.
 */
class ProductStatusController extends Controller
{
    /**
     * @var ProductRepository
     */
    protected $products;

    /**
     * @param ProductRepository $products
     */
    public function __construct(ProductRepository $products)
    {
        $this->products = $products;
    }

    /**
     * @param ManageProductRequest $request
     *
     * @return mixed
     */
    public function getDeactivated(ManageProductRequest $request)
    {
        return view('backend.catalog.deactivated');
    }

    /**
     * @param ManageProductRequest $request
     *
     * @return mixed
     */
    public function getDeleted(ManageProductRequest $request)
    {
        return view('backend.catalog.deleted');
    }

    /**
     * @param Product $product
     * @param $status
     * @param ManageProductRequest $request
     *
     * @return mixed
     */
    public function mark(Product $product, $status, ManageProductRequest $request)
    {
        $this->products->mark($product, $status);

        return redirect()->route($status == 1 ? 'admin.catalog.product.index' : 'admin.catalog.product.deactivated')->withFlashSuccess(trans('alerts.backend.products.updated'));
    }

    /**
     * @param Product              $deletedProduct
     * @param ManageProductRequest $request
     *
     * @return mixed
     */
    public function delete(Product $deletedProduct, ManageProductRequest $request)
    {
        $this->products->forceDelete($deletedProduct);

        return redirect()->route('admin.catalog.product.deleted')->withFlashSuccess(trans('alerts.backend.products.deleted_permanently'));
    }

    /**
     * @param Product              $deletedProduct
     * @param ManageProductRequest $request
     *
     * @return mixed
     */
    public function restore(Product $deletedProduct, ManageProductRequest $request)
    {
        $this->products->restore($deletedProduct);

        return redirect()->route('admin.catalog.product.index')->withFlashSuccess(trans('alerts.backend.products.restored'));
    }
}
