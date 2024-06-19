<?php

namespace Core;

use GuzzleHttp\Client;

class AI
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function sendRequest($model, $endpoint, $data)
    {
        $apiUrl = $this->getApiUrl($model);
        $apiKey = $this->getApiKey($model);

        $response = $this->client->post($apiUrl . $endpoint, [
            'headers' => [
                'Authorization' => "Bearer $apiKey",
                'Content-Type' => 'application/json'
            ],
            'json' => $data
        ]);

        return json_decode($response->getBody(), true);
    }

    private function getApiUrl($model)
    {
        switch ($model) {
            case 'chatgpt':
                return $_ENV['CHATGPT_API_URL'];
            case 'llama':
                return $_ENV['LLAMA_API_URL'];
            default:
                throw new \Exception("Unknown model: $model");
        }
    }

    private function getApiKey($model)
    {
        switch ($model) {
            case 'chatgpt':
                return $_ENV['CHATGPT_API_KEY'];
            case 'llama':
                return $_ENV['LLAMA_API_KEY'];
            default:
                throw new \Exception("Unknown model: $model");
        }
    }
}
