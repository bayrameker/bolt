<?php

namespace App\Repositories;

use App\Models\Home;

class HomeRepository
{
    public function getHomeData()
    {
        return new Home('Home Page', 'Welcome to My Bolt Framework!!');
    }
}
