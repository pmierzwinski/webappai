<?php

namespace App\Api;

use App\Interface\AIConnection;
use App\Utils\File\PromptsFactory;

class AIService
{
    private AIConnection $connection;
    private PromptsFactory $promptFactory;

    public function __construct(AIConnection $connection)
    {
        $this->connection = $connection;
        $this->promptFactory = new PromptsFactory();
    }

    public function getBetterCode(string $oldCode) : string
    {
        $prompt = $this->promptFactory->createBetterCodePrompt($oldCode);
        return $this->connection->ask($prompt);
    }
}
