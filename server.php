<?php

use App\App;

require_once __DIR__ . "/vendor/autoload.php";


function path($path): string
{
    return __DIR__ . "/$path";
}

App::make();
