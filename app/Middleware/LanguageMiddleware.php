<?php

namespace App\Middleware;

class LanguageMiddleware {
    public function handle($request, $next) {
        if (isset($_POST['lang'])) {
            $_SESSION['lang'] = $_POST['lang'];
        }

        return $next($request);
    }
}
