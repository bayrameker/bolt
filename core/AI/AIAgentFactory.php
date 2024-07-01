<?php

namespace Core\AI;

use Core\AI\Agents\ChatGPTAgent;
use Core\AI\Agents\LlamaAgent;

class AIAgentFactory
{
    public static function createAgent(string $service): AIAgentInterface
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
}
