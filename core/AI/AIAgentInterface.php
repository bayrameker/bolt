<?php

namespace Core\AI;

interface AIAgentInterface
{
    public function generateText(string $prompt): string;
    public function performTask(array $parameters): array;
}
