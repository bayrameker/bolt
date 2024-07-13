<?php

namespace App\Middleware;

use Core\Request;
use Core\Response;

class Vanguard
{
    public function handle(Request $request, Response $response, callable $next)
    {
        // Middleware logic before passing to next middleware or controller
        if ($request->header('X-Example-Header') !== 'expected-value') {
            $response->setStatusCode(403);
            $response->setContent('Forbidden');
            return $response;
        }

        // Call the next middleware or controller
        $response = $next($request, $response);

        // Middleware logic after passing through the next middleware or controller
        // (if needed)

        return $response;
    }
}
