<?php

namespace Core\AI;

use Core\AI\Agents\ChatGPTAgent;
use Core\AI\Agents\LlamaAgent;

class AIManager
{
    protected $agents;

    public function __construct()
    {
        $this->agents = [];
        $services = explode(',', getenv('AI_SERVICES'));
        foreach ($services as $service) {
            $this->agents[$service] = $this->createAgent($service);
        }
    }

    protected function createAgent(string $service): AIAgentInterface
    {
        switch ($service) {
            case 'chatgpt':
                return new ChatGPTAgent();
            case 'llama':
                return new LlamaAgent();
            default:
                throw new \Exception("Unsupported AI service: {$service}");
        }
    }

    public function generateText(string $service, string $prompt): string
    {
        if (!isset($this->agents[$service])) {
            throw new \Exception("Service {$service} not available.");
        }
        return $this->agents[$service]->generateText($prompt);
    }

    public function performTask(string $service, array $parameters): array
    {
        if (!isset($this->agents[$service])) {
            throw new \Exception("Service {$service} not available.");
        }
        return $this->agents[$service]->performTask($parameters);
    }
}
