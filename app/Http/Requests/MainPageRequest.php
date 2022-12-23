<?php

namespace App\Http\Requests;

use App\Http\Repositories\MainPageRepository;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;

class MainPageRequest extends FormRequest
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
        // dd($this->all());
          return RuleFactory::make([
            '%title%'             =>'required|string',
            '%description%'       =>'required|string',
            '%alt%'               =>'required|string',
            '%image%'             =>'required_without:id|image|mimes:jpg,png,jpeg,',
            'banner'             =>'nullable|image|mimes:jpg,png,jpeg,',
            'seo.%meta_title%'        =>'nullable|string',
            'seo.%meta_keywords%'     =>'nullable|string',
            'seo.%meta_description%'  =>'nullable|string',
            'seo.%slug%'              =>'nullable|string',

            // 'sections'                  =>($this->fixed_name == 'About') ? 'required|': 'nullable|' . "array",
            // 'sections.*.%description%'  => ($this->fixed_name == 'About') ? 'required|': 'nullable|' .'string',
            // 'sections.*.%title%'        => ($this->fixed_name == 'About') ? 'required|': 'nullable|' .'string',

         ]);

    }

    protected function prepareForValidation()
    {
        $languages    = new MainPageRepository();
        $languages    = $languages->languages()->pluck('code')->toArray();

        // $sections = [];
        // foreach ($this->sections?? [] as $section) {
        //     foreach ($languages as $code) {
        //         $arr[$code] = [
        //             'title' => @$section[$code.'_title'],
        //             'description' => @$section[$code.'_description'],
        //         ];
        //     }
        //     $sections [] = $arr;
        // }
        // request()->merge([
        //     'sections'      => $sections,
        // ]);
        // $this->merge([
        //     'sections'      => $sections,
        // ]);

    }


    public function messages()
    {
        return [
            'title' => 'Please Enter Title Value',
            'alt' => 'Please Enter Alt Value',
            'description' => 'Please Enter Description Value',
            'image' => 'Must Be Image Type',
            'meta_title' => 'Must Be Meta title Type',
            'meta_keywords' => 'Must Be Meta Keywords Type',
            'meta_description' => 'Must Be Meta Description Type',
            'slug' => 'Must Be slug Type',
        ];
    }
}
