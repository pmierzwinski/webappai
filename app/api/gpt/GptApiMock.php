<?php

class GptApiMock implements Api
{

    function call() : string
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

    function setHeaders(array $headers) : void
    {
        // TODO: Implement setHeaders() method.
    }

    function setData(array $headers) : void
    {
        // TODO: Implement setData() method.
    }
}