<?php

class App
{
    private AIService $aiService;

    public function __construct(AIConnection $connection)
    {
        $this->aiService = new AIService($connection);
    }

    public function updateProject()
    {
        $oldIndexCode = FileService::getIndexContent();

        $gptCode = $this->aiService->getBetterCodeThan($oldIndexCode);

        FileService::setIndexContent($gptCode);
    }
}