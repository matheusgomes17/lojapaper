<?php

namespace Snaketec\Http\Requests\Backend\Catalog\Product;

use Snaketec\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class StoreProductRequest.
 */
class StoreProductRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('manage-products');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|max:255',
            'cover'         => 'required',
            'code'          => 'required|max:50',
            'category_id'   => 'required',
            'description'   => 'required',
        ];
    }
}
