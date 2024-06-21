<?php

namespace Core;

abstract class Service
{
    protected $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }
}
