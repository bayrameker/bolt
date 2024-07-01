<?php

namespace Core\AI;

class AIManager
{
    protected $agents;

    public function __construct()
    {
        $this->agents = [];
        $services = explode(',', getenv('AI_SERVICES'));
        foreach ($services as $service) {
            $this->agents[$service] = AIAgentFactory::createAgent($service);
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
