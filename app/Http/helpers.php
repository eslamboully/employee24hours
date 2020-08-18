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

if (!function_exists('getLanguages')) {
    function getLanguages() {
        $languages = [
            'Afrikaans','Albanian','Arabic','Armenian','Basque','Bengali',
            'Bulgarian','Catalan','Cambodian','Chinese','Croatian','Czech',
            'Dutch','English','French','Turkish','Swedish','Spanish','Slovenian',
            'Slovak','Russian','Romanian','Quechua','Portuguese','Polish',
            'Persian','Norwegian','Mongolian','Lithuanian','Latin','Korean',
            'Javanese','Japanese','Italian','Irish','Indonesian','Icelandic',
            'Hungarian','Hindi','Greek','German',
        ];

        return $languages;
    }
}


if (!function_exists('im')) {
    function im($auth = null) {
        return auth($auth)->user();
    }
}
