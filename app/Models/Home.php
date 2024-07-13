<?php

namespace App\Models;

class Home
{
    public $title;
    public $message;

    public function __construct($title, $message)
    {
        $this->title = $title;
        $this->message = $message;
    }
}
