<?php
function loadTranslations($locale)
{
    $path = __DIR__ . "/../views/lang/$locale/messages.php";
    if (file_exists($path)) {
        return include $path;
    }
    return include __DIR__ . "/../views/lang/en/messages.php"; // Default to English
}

function __($key)
{
    static $translations = null;
    if ($translations === null) {
        $locale = $_SESSION['lang'] ?? 'en'; // Default locale
        $translations = loadTranslations($locale);
    }
    return $translations[$key] ?? $key;
}