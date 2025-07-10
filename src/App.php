<?php

namespace App;

use App\AI\AIService;
use App\Utils\File\FileService;

class App
{
    //TODO if exception - reset files, and save the old ones. - so having current and old index files
    private AIService $aiService;



    public function updateProject()
    {
        $indexCode = $this->updateIndexFile();
        $this->updateCssFile($indexCode);
        $this->updateJsFile($indexCode);
    }

    private function updateIndexFile() : string
    {
        $oldIndexCode = FileService::getIndexContent();
        $gptCode = $this->aiService->getBetterCode($oldIndexCode);//todo moze lepiej html do php dac?
        FileService::setIndexContent($gptCode);

        return $gptCode;
    }

    private function updateCssFile(string $indexCode) : string
    {
        //todo rozdzielic na klasy PhpCodeService::withHtmlFile()->getCode();
        $gptCode = $this->aiService->getBetterCode($indexCode);//todo moze lepiej html do php dac?
        FileService::setCssContent($gptCode);

        return $gptCode;
    }

    private function updateJsFile(string $indexCode) : string
    {
        //todo rozdzielic na klasy PhpCodeService::withHtmlFile()->getCode();
        $gptCode = $this->aiService->getBetterCode($indexCode);//todo moze lepiej html do php dac?
        FileService::setJsContent($gptCode);

        return $gptCode;
    }
}
