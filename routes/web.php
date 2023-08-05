<?php

use App\Router;

Router::get('/', function () {
    return file_get_contents(path('resources/views/index.html'));
});

Router::post('/clicked', function () {
    return "Clicked";
});
