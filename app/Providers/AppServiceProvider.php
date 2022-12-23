<?php

namespace App\Providers;

use App\Models\Language;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        if(Schema::hasTable('languages')){
            $languages = Language::where('isActive', 1)->pluck('code')->toArray();
            Config::set('translatable.locales', $languages);
        }
    }
}
