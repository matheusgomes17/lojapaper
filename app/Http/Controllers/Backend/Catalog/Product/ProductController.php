<?php

namespace Snaketec\Http\Controllers\Backend\Catalog\Product;

use Snaketec\Http\Requests\Backend\Catalog\Product\ManageProductRequest;
use Snaketec\Http\Requests\Backend\Catalog\Product\StoreProductRequest;
use Snaketec\Http\Requests\Backend\Catalog\Product\UpdateProductRequest;
use Snaketec\Http\Controllers\Controller;
use Snaketec\Models\Catalog\Product\Product;
use Snaketec\Repositories\Backend\Catalog\Category\CategoryRepository;
use Snaketec\Repositories\Backend\Catalog\Product\ProductRepository;

/**
 * Class ProductController.
 */
class ProductController extends Controller
{
    /**
     * @var ProductRepository
     */
    protected $products;

    /**
     * @var CategoryRepository
     */
    protected $categories;

    /**
     * @param ProductRepository $products
     * @param CategoryRepository $categories
     */
    public function __construct(ProductRepository $products, CategoryRepository $categories)
    {
        $this->products = $products;
        $this->categories = $categories;
    }

    /**
     * @param ManageProductRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageProductRequest $request)
    {
        return view('backend.catalog.index');
    }

    /**
     * @param ManageProductRequest $request
     *
     * @return mixed
     */
    public function create(ManageProductRequest $request)
    {
        $categories = $this->products->getCategoryOptions();
        return view('backend.catalog.create', compact('categories'));
    }

    /**
     * @param StoreProductRequest $request
     *
     * @return mixed
     */
    public function store(StoreProductRequest $request)
    {
        $this->products->create(['data' => $request->all()]);

        return redirect()->route('admin.catalog.product.index')->withFlashSuccess(trans('alerts.backend.products.created'));
    }

    /**
     * @param Product              $product
     * @param ManageProductRequest $request
     *
     * @return mixed
     */
    public function show(Product $product, ManageProductRequest $request)
    {
        return view('backend.catalog.show')
            ->withProduct($product);
    }

    /**
     * @param Product              $product
     * @param ManageProductRequest $request
     *
     * @return mixed
     */
    public function edit(Product $product, ManageProductRequest $request)
    {
        $categories = $this->categories->getCategoryOptions();
        return view('backend.catalog.edit', compact('categories'))
            ->withProduct($product);
    }

    /**
     * @param Product              $product
     * @param UpdateProductRequest $request
     *
     * @return mixed
     */
    public function update(Product $product, UpdateProductRequest $request)
    {
        $this->products->update($product, ['data' => $request->all()]);

        return redirect()->route('admin.catalog.product.index')->withFlashSuccess(trans('alerts.backend.products.updated'));
    }

    /**
     * @param Product              $product
     * @param ManageProductRequest $request
     *
     * @return mixed
     */
    public function destroy(Product $product, ManageProductRequest $request)
    {
        $this->products->delete($product);

        return redirect()->route('admin.catalog.product.deleted')->withFlashSuccess(trans('alerts.backend.products.deleted'));
    }
}
