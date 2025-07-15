<?php

namespace App\AI\Test;

use App\AI\AIService;

class FakeConnection extends AIService
{
    public function ask(string $prompt) : string
    {
        return "@@@UPDATE%%%index1.php%%%<?php echo('siema');";
    }
}
