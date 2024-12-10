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
        $indexCode = $this->updateIndexFile();
        $this->updateCssFileForIndexCode($indexCode);
        $this->updateJsFileForIndexCode($indexCode);
    }

    /**
     * @return void
     */
    private function updateIndexFile() : string
    {
        $oldIndexCode = FileService::getIndexContent();
        //todo rozdzielic na klasy PhpCodeService::withHtmlFile()->getCode();
        $gptCode = $this->aiService->getPhpCodeWithOneHtmlFile($oldIndexCode, "test.html");//todo moze lepiej html do php dac?
        FileService::setIndexContent($gptCode);

        return $gptCode;
    }

    /**
     * @return void
     */
    private function updateCssFileForIndexCode(string $indexCode) : string
    {
        //todo rozdzielic na klasy PhpCodeService::withHtmlFile()->getCode();
        $gptCode = $this->aiService->getCssCodeForPhpFile($indexCode);//todo moze lepiej html do php dac?
        FileService::setCssContent($gptCode);

        return $gptCode;
    }

    /**
     * @return void
     */
    private function updateJsFileForIndexCode(string $indexCode) : string
    {
        //todo rozdzielic na klasy PhpCodeService::withHtmlFile()->getCode();
        $gptCode = $this->aiService->getJsCodeForPhpFile($indexCode);//todo moze lepiej html do php dac?
        FileService::setJsContent($gptCode);

        return $gptCode;
    }
}