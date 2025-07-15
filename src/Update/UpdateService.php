<?php

namespace App\Update;

use App\AI\AIService;
use App\Backup\BackupService;
use App\Framework\Framework;
use App\Update\Command\CommandFactory;
use App\Update\Command\Invoker;

class UpdateService
{
    private $appDir;

    public function __construct(
        private AIService $aiService,
        private BackupService $backupService
    ) {
        $this->appDir = Framework::$projectDir."/../public/app";
    }

    public function updateProject()
    {
        $this->backupService->makeCopy();
        $this->updateFiles();

//        if(!$this->tryCompileIndex()){
//            $this->backupService->rollback();
//        }
    }


    private function updateFiles() : void
    {
        $commands = $this->askForCommands();
        $invoker = new Invoker($commands);
        $invoker->run();
    }

    private function askForCommands()
    {
        $factory = new CommandFactory();

        $response = $this->aiService->getBetterCode($this->getIndexContent());
        return $factory->parseToCommands($response);
    }

    private function tryCompileIndex()
    {
        $indexPath = $this->appDir."/index.php";
        $response = shell_exec("php -l index.php");//nie dziala

        var_dump($response);
        return $response;
    }


    private function getIndexContent()
    {
        return file_get_contents($this->appDir."/index.php");
    }

    public function createFile($fileName, $content)
    {
        file_put_contents($this->appDir."/".$fileName, $content);
//        $this->newFiles[] = $
    }

    public function updateFile($fileName, $content) {
        file_put_contents($this->appDir."/".$fileName, $content);
    }
}
