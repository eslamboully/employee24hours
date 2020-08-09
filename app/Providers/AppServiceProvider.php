<?php

namespace App\Providers;

use App\Models\Language;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


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
        $langs = Language::with(['language_configs'])->get();
        $languages = [];
        foreach($langs as $lang){
            $languages[$lang->locale] = $lang;
        }

        View::share(['languages' => $languages]);
    }
}
