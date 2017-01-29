<?php

namespace Snaketec\Http\Controllers\Backend\Catalog\Category;

use Snaketec\Http\Requests\Backend\Catalog\Category\ManageCategoryRequest;
use Snaketec\Http\Requests\Backend\Catalog\Category\StoreCategoryRequest;
use Snaketec\Http\Requests\Backend\Catalog\Category\UpdateCategoryRequest;
use Snaketec\Http\Controllers\Controller;
use Snaketec\Models\Catalog\Category\Category;
use Snaketec\Repositories\Backend\Catalog\Category\CategoryRepository;

/**
 * Class CategoryController.
 */
class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected $categories;

    /**
     * @param CategoryRepository $categories
     */
    public function __construct(CategoryRepository $categories)
    {
        $this->categories = $categories;
    }

    /**
     * @param ManageCategoryRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageCategoryRequest $request)
    {
        return view('backend.catalog.categories.index');
    }

    /**
     * @param ManageCategoryRequest $request
     *
     * @return mixed
     */
    public function create(ManageCategoryRequest $request)
    {
        $categories = $this->categories->getCategoryOptions();
        return view('backend.catalog.categories.create', compact('categories'));
    }

    /**
     * @param StoreCategoryRequest $request
     *
     * @return mixed
     */
    public function store(StoreCategoryRequest $request)
    {
        $this->categories->create(['data' => $request->all()]);

        return redirect()->route('admin.catalog.category.index')->withFlashSuccess(trans('alerts.backend.categories.created'));
    }

    /**
     * @param Category              $category
     * @param ManageCategoryRequest $request
     *
     * @return mixed
     */
    public function edit(Category $category, ManageCategoryRequest $request)
    {
        $categories = $this->categories->getCategoryOptions($category);
        return view('backend.catalog.categories.edit', compact('categories'))
            ->withCategory($category);
    }

    /**
     * @param Category              $category
     * @param UpdateCategoryRequest $request
     *
     * @return mixed
     */
    public function update(Category $category, UpdateCategoryRequest $request)
    {
        $this->categories->update($category, ['data' => $request->all()]);

        return redirect()->route('admin.catalog.category.index')->withFlashSuccess(trans('alerts.backend.categories.updated'));
    }

    /**
     * @param Category              $category
     * @param ManageCategoryRequest $request
     *
     * @return mixed
     */
    public function destroy(Category $category, ManageCategoryRequest $request)
    {
        $this->categories->delete($category);

        return redirect()->route('admin.catalog.category.index')->withFlashSuccess(trans('alerts.backend.categories.deleted'));
    }
}
