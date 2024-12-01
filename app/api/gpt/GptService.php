<?php

class GptService implements AIService
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
        $responseData = json_decode($response, true);

        if (isset($responseData['choices'][0]['message']['content'])) {
            return $responseData['choices'][0]['message']['content'];
        } else {
            throw new Exception("Błąd: Brak odpowiedzi od API.");
        }
    }



}