<?php

namespace App\Exceptions;

class ViewNotFoundException extends \Exception
{

    public function __construct($view)
    {
        $this->message = "view file: $view does not exist";
    }
}


