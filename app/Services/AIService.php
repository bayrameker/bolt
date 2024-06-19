<?php

namespace App\Services;

use GuzzleHttp\Client;
use Core\AI;

class AIService extends AI
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $_ENV['AI_API_BASE_URI']
        ]);
    }

    public function analyzeText($text)
    {
        $response = $this->client->post('/analyze', [
            'json' => ['text' => $text]
        ]);

        return json_decode($response->getBody(), true);
    }

    public function generateText($prompt)
    {
        $response = $this->client->post('/generate', [
            'json' => ['prompt' => $prompt]
        ]);

        return json_decode($response->getBody(), true);
    }
}
