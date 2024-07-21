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


function getReactBuildFile() {
    $buildDir = __DIR__ . '/../../public/react-app/build/static/js';
    $files = scandir($buildDir);
    foreach ($files as $file) {
        if (strpos($file, 'main.') === 0 && strpos($file, '.js') !== false) {
            return "/react-app/build/static/js/$file";
        }
    }
    return null;
}
