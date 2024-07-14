<?php


use Core\Session;

global $router; // global değişkeni erişin

$router->get('/', [App\Controllers\HomeController::class, 'index']);

$router->post('/set-language', function() {
    if (isset($_POST['lang'])) {
        \Core\Session::put('lang', $_POST['lang']);
    }
    header('Location: /');
});
