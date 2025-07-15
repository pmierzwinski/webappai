<?php

namespace App\Update;

use App\AI\Test\FakeConnection;
use App\Framework\Attribute\Handler;
use App\Route\Interfaces\HandlerInterface;

#[Handler('/update')]
class UpdateHandler implements HandlerInterface
{
    public function handle() : void
    {
        $service = new UpdateService(new FakeConnection());
        $service->updateProject();
    }
}