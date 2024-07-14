<?php

use App\Helper\Language;

if (!function_exists('__')) {
    function __($key) {
        static $language = null;

        if ($language === null) {
            $lang = $_SESSION['lang'] ?? 'en';
            $language = new Language($lang);
        }

        return $language->get($key);
    }
}

if (!function_exists('lang')) {
    function lang($key) {
        return __($key);
    }
}
