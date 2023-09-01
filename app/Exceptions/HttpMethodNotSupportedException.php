<?php

namespace App\Exceptions;

class HttpMethodNotSupportedException extends \Exception
{

    public function __construct($method)
    {
        $this->message = $method.' is not supported for this route';
    }
}

