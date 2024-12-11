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

    public function getIndexCode(string $oldCode, string $importCode) : string
    {
        $prompt = $this->promptFactory->betterCodeThan($oldCode);
        $response = $this->connection->ask($prompt);

        return Utils::ensurePhpCode($response);
    }

    public function getCssCodeForPhpFile(string $oldCode) : string
    {
        $prompt = $this->promptFactory->getCssForPhpCode($oldCode);
        $response = $this->connection->ask($prompt);

        return Utils::ensureCssCode($response);
    }

    public function getJsCodeForPhpFile(string $oldCode) : string
    {
        $prompt = $this->promptFactory->getJsForPhpCode($oldCode);
        $response = $this->connection->ask($prompt);

        return Utils::ensureJsCode($response);
    }
}