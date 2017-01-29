<?php

namespace Snaketec\Http\Requests\Backend\Catalog\Product;

use Snaketec\Http\Requests\Request;

/**
 * Class ManageProductRequest.
 */
class ManageProductRequest extends Request
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
            //
        ];
    }
}
