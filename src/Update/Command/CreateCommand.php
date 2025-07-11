<?php

namespace App\Update\Command;

use App\Update\UpdateService;

class CreateCommand implements CommandInterface
{
    public function __construct(
        private UpdateService $app,
        private string $fileName,
        private string $content
    ) { }

    public function execute()
    {
        $this->app->updateProject();
    }
}