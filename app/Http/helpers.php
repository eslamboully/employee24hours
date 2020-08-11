<?php

use App\Models\Language;

if (!function_exists('active')) {
    function active($segment) {
        if ($segment == request()->segment('2')) {
            return 'active';
        }
        return '';
    }
}

if (!function_exists('current_langs')) {
    function current_langs() {
        $langs = Language::with(['language_configs'])->get();
        $languages = [];
        foreach($langs as $lang){
            array_push($languages,$lang->locale);
        }

        return $languages;
    }
}
