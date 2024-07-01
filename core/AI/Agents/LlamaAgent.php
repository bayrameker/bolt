<?php

namespace Core\AI\Agents;

use GuzzleHttp\Client;
use Core\AI\AIAgentInterface;

class LlamaAgent implements AIAgentInterface
{
    protected $client;
    protected $apiUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiUrl = getenv('LLAMA_API_URL');
        $this->apiKey = getenv('LLAMA_API_KEY');
    }

    public function generateText(string $prompt): string
    {
        $response = $this->client->post($this->apiUrl . '/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'text-llama-003',
                'prompt' => $prompt,
                'max_tokens' => 100,
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['choices'][0]['text'];
    }

    public function performTask(array $parameters): array
    {
        // Implement other tasks specific to Llama if needed
        return [];
    }
}
