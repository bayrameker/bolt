<?php

namespace Core;

abstract class Controller
{
    protected function render($view, $data = [])
    {
        View::render($view, $data);
    }
}
