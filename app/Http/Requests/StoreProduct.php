<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
            'sku'=>'required|numeric',
            'price'=>'required|numeric',
            'name'=>'required|string',
            'description'=>'required|string',
            'main_image'=>'required_without:id|image|mimes:png,jpg',
            'quantity' =>'required|numeric'
        ];
    }
}
