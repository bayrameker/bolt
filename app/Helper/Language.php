<?php
namespace App\Helper;

class Language {
    protected $lang = 'en';
    protected $translations = [];

    public function __construct($lang) {
        $this->lang = $lang;
        $this->loadTranslations();
    }

    protected function loadTranslations() {
        $file = __DIR__ . "/../Views/lang/{$this->lang}/messages.php";
        if (file_exists($file)) {
            $this->translations = include $file;
        } else {
            throw new \Exception("Language file not found: {$file}");
        }
    }

    public function get($key) {
        return $this->translations[$key] ?? $key;
    }
}
