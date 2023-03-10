<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLanguage extends FormRequest
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
            'lang'=>'required|string',
            'code'=>'required|string',
            'flag'=>'nullable|image|mimes:png,jpg,jpeg',
        ];
    }

    public function messages()
    {
        return [
            'lang' => 'Please Enter Language Name',
            'code' => 'Please Enter Code Value',
            'flag' => 'Flag Type Must Be Image Type',
        ];
    }
}
