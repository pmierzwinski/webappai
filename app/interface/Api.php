<?php

interface Api
{
    function call() : string;
    function setHeaders(array $headers) : void;
    function setData(array $headers) : void;
}