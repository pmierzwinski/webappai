<?php

namespace App\AI\Test;

use App\Interface\IApi;
use App\Utils\File\FileService;

class FakeApi implements IApi
{
    public function call() : string
    {
        $indexContent = FileService::getIndexContent();

        $fakeData = [
            'choices' => [
                [
                    'message' => [
                        'content' => $indexContent."echo(".(string)rand().");"
                    ]
                ]
            ]
        ];
        return json_encode($fakeData);
    }

    public function setHeaders(array $headers) : void
    {
        //Implement setHeaders() method.
    }

    public function setData(array $headers) : void
    {
        //Implement setData() method.
    }
}
