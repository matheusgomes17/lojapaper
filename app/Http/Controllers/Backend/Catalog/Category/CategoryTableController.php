<?php

namespace Snaketec\Http\Controllers\Backend\Catalog\Category;

use Snaketec\Http\Controllers\Controller;
use Snaketec\Http\Requests\Backend\Catalog\Category\ManageCategoryRequest;
use Snaketec\Repositories\Backend\Catalog\Category\CategoryRepository;
use Yajra\Datatables\Facades\Datatables;

/**
 * Class CategoryTableController.
 */
class CategoryTableController extends Controller
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
     * @return mixed
     */
    public function __invoke(ManageCategoryRequest $request)
    {
        return Datatables::of($this->categories->getForDataTable())
            ->addColumn('actions', function ($category) {
                return $category->action_buttons;
            })
            ->make(true);
    }
}
