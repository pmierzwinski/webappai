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
        $response = $this->connection->ask($prompt);

        return Utils::ensurePhpCode($response);
    }
}