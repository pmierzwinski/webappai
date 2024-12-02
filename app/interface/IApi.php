<?php

interface IApi
{
    function call() : string;
    function setHeaders(array $headers) : void;
    function setData(array $headers) : void;
}