<?php

class App
{
    private GptService $aiService;

    public function __construct(AIService $service)
    {
        $this->aiService = $service;
    }

    public function updateProject()
    {
        $oldIndexCode = FileService::getIndexContent();

        $gptCode = $this->aiService->getBetterCodeThan($oldIndexCode);

        FileService::setIndexContent($gptCode);
    }
}