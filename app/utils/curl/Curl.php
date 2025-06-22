<?php

namespace App\Utils\File\Curl;

use Exception;

class Curl
{
    public static function call($url, $headers, $data)
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception('Błąd cURL: ' . curl_error($ch));
        }

        return $response;
    }
}
