<?php

namespace Core;

class View
{
    public static function render($view, $data = [])
    {
        extract($data);
        $viewFile = __DIR__ . '/../app/Views/' . $view . '.php';
        if (file_exists($viewFile)) {
            include __DIR__ . '/../app/Views/layout.php';
        } else {
            echo "View file not found: " . $viewFile;
        }
    }
}
