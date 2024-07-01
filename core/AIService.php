<?php

namespace Core\Services;

use GuzzleHttp\Client;

class AIService
{
    protected $client;
    protected $services;

    public function __construct()
    {
        $this->client = new Client();
        $this->services = explode(',', getenv('AI_SERVICES'));
    }

    public function generateText($service, $prompt)
    {
        if (!in_array($service, $this->services)) {
            throw new \Exception("Service {$service} not configured.");
        }

        switch ($service) {
            case 'chatgpt':
                return $this->generateChatGPTText($prompt);
            case 'llama':
                return $this->generateLlamaText($prompt);
            default:
                throw new \Exception("Unsupported service: {$service}");
        }
    }

    private function generateChatGPTText($prompt)
    {
        $response = $this->client->post(getenv('CHATGPT_API_URL') . '/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . getenv('CHATGPT_API_KEY'),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'text-davinci-003',
                'prompt' => $prompt,
                'max_tokens' => 100,
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['choices'][0]['text'];
    }

    private function generateLlamaText($prompt)
    {
        $response = $this->client->post(getenv('LLAMA_API_URL') . '/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . getenv('LLAMA_API_KEY'),
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
}
