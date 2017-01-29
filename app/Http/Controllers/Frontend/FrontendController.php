<?php

namespace Snaketec\Http\Controllers\Frontend;

use Snaketec\Http\Controllers\Controller;
use Snaketec\Repositories\Backend\Catalog\Category\CategoryRepository;
use Snaketec\Repositories\Backend\Catalog\Product\ProductRepository;

/**
 * Class FrontendController.
 */
class FrontendController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected $categories;

    /**
     * @var ProductRepository
     */
    protected $products;

    /**
     * FrontendController constructor.
     * @param CategoryRepository $categories
     * @param ProductRepository $products
     */
    public function __construct(CategoryRepository $categories, ProductRepository $products)
    {
        $this->categories = $categories;
        $this->products = $products;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $menus = $this->categories->getAll()->linkNodes()->toTree();
        $papelDeParede = $this->categories->find(2)->products->random(8);

        return view('frontend.index', compact('menus', 'papelDeParede'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function product()
    {
        $menus = $this->categories->getAll()->linkNodes()->toTree();

        return view('frontend.product', compact('menus'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function category()
    {
        $menus = $this->categories->getAll()->linkNodes()->toTree();

        return view('frontend.category', compact('menus'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function macros()
    {
        return view('frontend.macros');
    }
}
