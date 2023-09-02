<?php

use App\App;

require_once __DIR__ . "/vendor/autoload.php";

define('STORAGE_PATH', __DIR__ ."/storage/");
define('VIEW_PATH', __DIR__ ."/resources/views/");


function path($path): string
{
    return __DIR__ . "/$path";
}

App::make();

require_once __DIR__ ."/routes/web.php";
