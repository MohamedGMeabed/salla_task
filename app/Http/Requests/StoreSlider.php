<?php

namespace App\Http\Requests;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;
use Astrotomic\Translatable\Validation\RuleFactory;

class StoreSlider extends FormRequest
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
        return RuleFactory::make([
            '%title%'      => 'required|string',
            '%description%'=> 'required|string',
            'btn'          =>'nullable|url',
            '%alt%'        =>'nullable|string',
            'image'        =>'required_without:id|image|mimes:jpg,png,jpeg,'
        ]);
    }


    public function messages()
    {
        return [
            'title'       => 'Please Enter Title Value',
            'btn'         => 'BTN Must Be a Link',
            'description' => 'Please Enter Description Value',
            'image'       => 'Must Be Image Type',
        ];
    }

    protected function prepareForValidation()
    {
        $languages    = Language::where('isActive',1)->pluck('code')->toArray();
        $attachment   = ['is_main' => 1];
        foreach ($languages as $key => $code) {
            $attachment[$code]  = [
                'alts'   =>  @$this->$code['alt'],
            ];
            // image cannot uploaded twice
            if($this->image && !$key){
                $attachment[$code]['file'] = $this->image;
            }
        }
        $this->merge([
            'attachment'       => $attachment,
        ]);
    }

}
