<?php

namespace App\Http\Requests;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Astrotomic\Translatable\Validation\RuleFactory;

class StoreService extends FormRequest
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
            '%title%'                =>'required|string',
            '%description%'          =>'required|string',
            'seo.%meta_title%'       =>'nullable|string',
            'seo.%meta_keywords%'    =>'nullable|string',
            'seo.%meta_description%' =>'nullable|string',
            'seo.%slug%'             =>'nullable|string',
            'image'     =>'required_without:id|image|mimes:jpg,png,jpeg,',
         ]);
    }



    protected function prepareForValidation()
    {
        $languages    = Language::where('isActive',1)->pluck('code')->toArray();
        $attachments = [];

        $seo = [];
        $req_seo = $this->seo;
        $data = $this->all();
        foreach ($languages as $language_code)
        {
            $seo[$language_code] = [
                "meta_title"       => @$req_seo[$language_code]['meta_title']                     ??  @$this->$language_code['title'] ,
                "slug"             => @Str::replace(' ' ,'-' ,@$req_seo[ $language_code]['slug']) ??  Str::replace(' ' , '-' , @$this->$language_code['title'])  ,
                "meta_keywords"    => @$req_seo[$language_code]['meta_keywords']                  ??  @$this->$language_code['title'] ,
                "meta_description" => @$req_seo[$language_code]['meta_description']               ?? trim(strip_tags(substr($this->$language_code['description'] ,0,255))),
            ];

            $attachments[$language_code]['file'] = $this->image;
            $attachments[$language_code]['alts'] = $data[$language_code]['alt'] ??  @$data[$language_code]['title'] ;
        }
     
        $this->merge([
            'attachments' => $attachments,
            'seo'        => $seo,
        ]);
    }
}
