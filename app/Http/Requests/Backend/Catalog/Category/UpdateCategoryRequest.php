<?php

namespace Snaketec\Http\Requests\Backend\Catalog\Category;

use Snaketec\Http\Requests\Request;

/**
 * Class UpdateCategoryRequest.
 */
class UpdateCategoryRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('manage-categories');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
