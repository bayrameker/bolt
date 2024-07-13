<?php

namespace App\Services;

use App\Repositories\HomeRepository;

class HomeService
{
    protected $repository;

    public function __construct(HomeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getHomeData()
    {
        return $this->repository->getHomeData();
    }
}
