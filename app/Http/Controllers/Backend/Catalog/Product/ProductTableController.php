<?php

namespace Snaketec\Http\Controllers\Backend\Catalog\Product;

use Snaketec\Http\Controllers\Controller;
use Snaketec\Http\Requests\Backend\Catalog\Product\ManageProductRequest;
use Snaketec\Repositories\Backend\Catalog\Product\ProductRepository;
use Yajra\Datatables\Facades\Datatables;

/**
 * Class ProductTableController.
 */
class ProductTableController extends Controller
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
    public function __invoke(ManageProductRequest $request)
    {
        return Datatables::of($this->products->getForDataTable($request->get('status'), $request->get('trashed')))
            ->addColumn('category', function ($product) {
                return $product->categories->name;
            })
            ->addColumn('actions', function ($product) {
                return $product->action_buttons;
            })
            ->withTrashed()
            ->make(true);
    }
}
