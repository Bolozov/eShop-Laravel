<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductFormRequest extends FormRequest
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
            'name' => 'required|max:255',
            'sku' => 'required',
            'brand_id' => 'required',
            'price' => 'required|numeric',
            'special_price' => 'nullable|numeric|lt:price',
            'quantity' => 'required|numeric',
            'weight'=> 'nullable|numeric',
            'categories' => 'required|array|min:1'
        ];
    }
}
