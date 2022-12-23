<?php

namespace Database\Seeders;

use App\Models\MainPage;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class MainPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('seos')->where('seoable_type', 'App\Models\MainPage')->delete();
        DB::table('main_pages')->truncate();
        DB::table('main_page_translations')->truncate();
        Schema::enableForeignKeyConstraints();

        //Home
        $mainPage = MainPage::create([
            'fixed_name' => 'Home',
            'logo' => '1640089701_en.png',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'parent_id' => null,
            'en' => [
                'title' => 'Home',
                'image' => 'Home.jpg',
                'alt' => 'Home',
                'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout'
            ],
            'ar' => [
                'title' => 'الرئيسية',
                'image' => 'Home.png',
                'alt' => 'الرئيسية',
                'description' => 'حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.'
            ],
        ]);
        $mainPage->seo()->create([
            'en' => [
                'slug' => Str::slug('/'),
                'meta_title' => 'Home',
                'meta_keywords' => 'Home',
                'meta_description' => 'Home ',
            ],
            'ar' => [
                'slug' => Str::replace(' ', '-', 'الرئيسية'),
                'meta_title' => 'الرئيسية',
                'meta_keywords' => 'الرئيسية',
                'meta_description' => 'الرئيسية',
            ],
        ]);


        //About
        $mainPage = MainPage::create([
            'fixed_name' => 'About',
            'logo' => '1640089701_en.png',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'parent_id' => null,
            'en' => [
                'title' => 'About',
                'image' => '1640089701_en.png',
                'alt' => 'About',
                'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout'
            ],
            'ar' => [
                'title' => 'من نحن',
                'image' => '1640089701_ar.png',
                'alt' => 'من نحن',
                'description' => 'حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.'
            ],
        ]);
        $mainPage->seo()->create([
            'en' => [
                'slug' => Str::replace(' ', '-', 'about'),
                'meta_title' => 'About',
                'meta_keywords' => 'About',
                'meta_description' => 'About',
            ],
            'ar' => [
                'slug' => Str::replace(' ', '-', 'about'),
                'meta_title' => 'من نحن',
                'meta_keywords' => 'من نحن',
                'meta_description' => 'من نحن',
            ],
        ]);

        //Contact
        $mainPage = MainPage::create([
                'fixed_name' => 'Contact',
                'logo' => 'contact_en.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'parent_id' => null,
                'en' => [
                    'title' => 'Contact',
                    'image' => 'contact_en.png',
                    'alt' => 'Contact',
                    'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout'
                ],
                'ar' => [
                    'title' => 'تواصل معنا',
                    'image' => 'contact_ar.png',
                    'alt' => 'تواصل معنا',
                    'description' => 'حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.'
                ],
        ]);
        $mainPage->seo()->create([
            'en' => [
                'slug' => Str::replace(' ', '-', 'contact'),
                'meta_title' => 'Contact',
                'meta_keywords' => 'Contact',
                'meta_description' => 'Contact',
            ],
            'ar' => [
                'slug' => Str::replace(' ', '-', 'Contact Us'),
                'meta_title' => 'تواصل معنا',
                'meta_keywords' => 'تواصل معنا',
                'meta_description' => 'تواصل معنا',
            ],
        ]);

        //services
        $mainPage = MainPage::create([
            'fixed_name' => 'Services',
            'logo' => 'services.png',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'parent_id' => null,
            'en' => [
                'title' => 'Services',
                'image' => 'services.png',
                'alt' => 'Services',
                'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout'
            ],
            'ar' => [
                'title' => 'الخدمات ',
                'image' => 'Services.png',
                'alt' => 'الخدمات ',
                'description' => 'حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.'
            ],
        ]);
        $mainPage->seo()->create([
            'en' => [
                'slug' => Str::replace(' ', '-', 'services'),
                'meta_title' => 'services',
                'meta_keywords' => 'services',
                'meta_description' => 'services',
            ],
            'ar' => [
                'slug' => Str::replace(' ', '-', 'services'),
                'meta_title' => 'تواصل معنا',
                'meta_keywords' => 'تواصل معنا',
                'meta_description' => 'تواصل معنا',
            ],
        ]);



    }
}
