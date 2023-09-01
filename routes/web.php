<?php

use App\Router;

Router::get('/', function () {
    return file_get_contents(path('resources/views/index.html'));
});

Router::post('/clicked', function () {
    return "Clicked";
});

Router::get('/test',[\App\Http\Controllers\TestController::class, 'index']);
Router::get('/test/nest',[\App\Http\Controllers\TestController::class, 'nest']);
