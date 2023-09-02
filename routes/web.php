<?php

use App\Router;
use App\View;

Router::get('/', function () {
    return View::make('index.php');
});

Router::post('/clicked', function () {
    return "Clicked";
});

Router::get('/test',[\App\Http\Controllers\TestController::class, 'index']);
Router::get('/test/nest',[\App\Http\Controllers\TestController::class, 'nest']);
