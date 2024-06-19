<?php

namespace Core;

abstract class Service
{
    // Ortak service işlevleri buraya eklenebilir
    protected function log($message)
    {
        // Basit bir log işlevi
        file_put_contents(__DIR__ . '/../storage/logs/service.log', $message . PHP_EOL, FILE_APPEND);
    }
}
