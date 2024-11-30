<?php

class App
{
    const PUBLIC_FOLDER_PATH = __DIR__.'/../public';
    const INDEX_PATH = self::PUBLIC_FOLDER_PATH.'/index.php';

    private GptApi $gptService;

    public function __construct($gptService)
    {
        $this->gptService = $gptService;
    }

    public function updateProject()
    {
        $oldIndexCode = $this->getIndexContent();
        $gptCode = $this->gptService->getNewCode($oldIndexCode);
        $this->setIndexContent($gptCode);
    }

    public function getIndexContent() : string
    {
        return $this->getFileContent(self::INDEX_PATH);
    }

    public function setIndexContent(string $content) : void
    {
        $this->setFileContent(self::INDEX_PATH, $content);
    }

    public function setFileContent(string $filePath, string $newContent) : void
    {
        if (file_put_contents($filePath, $newContent) === false) {
            throw new Exception('Nie udało się zapisać do pliku');
        }
    }

    private function getFileContent($filePath) : string
    {
        $fileContent = file_get_contents($filePath);
        if ($fileContent === false) {
            throw new Exception('Nie udało się odczytać pliku');
        }
        return $fileContent;
    }
}