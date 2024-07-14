<?php

namespace App\Middleware;

use Closure;
use Core\Session;

class LanguageSwitcher
{
    public function handle($request, Closure $next)
    {
        Session::start();
        $locale = $request->get('lang', Session::get('lang', 'en'));
        Session::put('lang', $locale);

        $this->setLocale($locale);

        return $next($request);
    }

    protected function setLocale($locale)
    {
        if (file_exists(__DIR__ . "/../views/lang/$locale/messages.php")) {
            app()->setLocale($locale);
        } else {
            app()->setLocale('en');
        }
    }
}
