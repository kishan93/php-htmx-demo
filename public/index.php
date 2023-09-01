<?php

use App\App;
use App\Router;

require_once __DIR__ ."/../server.php";
require_once __DIR__ ."/../routes/web.php";
App::instance()->setContent(Router::handle());
echo App::instance()->render();
