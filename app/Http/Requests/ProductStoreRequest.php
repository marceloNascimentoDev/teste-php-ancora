<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "code"      => "required|string|min:3|max:100",
            "name"      => "required|string|min:3|max:100",
            "price"     => "required|numeric|min:0|max:999",
            "amount"    => "required|integer|min:0|max:999",
            "brand"     => "required|string|min:3|max:255"
        ];
    }

}
