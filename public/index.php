<?php

use App\App;
use App\Router;

require_once __DIR__ ."/../server.php";

echo App::instance()->handle();
