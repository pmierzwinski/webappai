<?php

namespace App\Update;

use App\AI\Test\TestAIService;
use App\Backup\BackupService;
use App\Framework\Attribute\Handler;
use App\Framework\Framework;
use App\Route\Interfaces\HandlerInterface;

#[Handler('/update')]
class UpdateHandler implements HandlerInterface
{
    public function handle() : void
    {
        $testService = new TestAIService();
        $testService->mockResponse("@@@UPDATE%%%index1.php%%%<?php echo('siema');");

        $service = new UpdateService(
            new TestAIService(),
            new BackupService(Framework::$projectDir."/public/app")
        );
        $service->updateProject();
    }
}