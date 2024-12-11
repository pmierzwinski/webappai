<?php

class App
{
    //TODO if exception - reset files, and save the old ones. - so having current and old index files
    private AIService $aiService;

    public function __construct(AIConnection $connection)
    {
        $this->aiService = new AIService($connection);
    }

    public function updateProject()
    {
        $indexCode = $this->updateIndexFile();
        $this->updateCssFile($indexCode);
        $this->updateJsFile($indexCode);
    }

    private function updateIndexFile() : string
    {
        $oldIndexCode = FileService::getIndexContent();
        $gptCode = $this->aiService->getIndexCode($oldIndexCode, "test.html");//todo moze lepiej html do php dac?
        FileService::setIndexContent($gptCode);

        return $gptCode;
    }

    /**
     * @return void
     */
    private function updateCssFile(string $indexCode) : string
    {
        //todo rozdzielic na klasy PhpCodeService::withHtmlFile()->getCode();
        $gptCode = $this->aiService->getCssCodeForPhpFile($indexCode);//todo moze lepiej html do php dac?
        FileService::setCssContent($gptCode);

        return $gptCode;
    }

    /**
     * @return void
     */
    private function updateJsFile(string $indexCode) : string
    {
        //todo rozdzielic na klasy PhpCodeService::withHtmlFile()->getCode();
        $gptCode = $this->aiService->getJsCodeForPhpFile($indexCode);//todo moze lepiej html do php dac?
        FileService::setJsContent($gptCode);

        return $gptCode;
    }
}