<?php

class Curl
{
    public static function call($url, $headers, $data)
    {
        // Inicjalizacja cURL
        $ch = curl_init($url);

        // Ustawienie opcji cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));


        $response = curl_exec($ch);
        // Obsługa błędów
        if (curl_errno($ch)) {
            throw new Exception('Błąd cURL: ' . curl_error($ch));
        }

        // Wykonanie zapytania
        return $response;
    }
}