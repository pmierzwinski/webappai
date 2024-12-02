<?php

class AIService
{
    private AIConnection $connection;
    private PromptsFactory $promptFactory;

    public function __construct(AIConnection $connection)
    {
        $this->connection = $connection;
        $this->promptFactory = new PromptsFactory();
    }

    public function getBetterCodeThan(string $oldCode) : string
    {
        $prompt = $this->promptFactory->newCodeForOldCode($oldCode);
        return $this->connection->ask($prompt);
    }
}