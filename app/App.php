<?php

namespace App;


class App
{
    protected static App $instance;

    protected string $content = "";

    public function __construct()
    {
        //
    }

    public function handle()
    {
        return Router::handle();
    }

    public static function make(...$args): static
    {
        return static::$instance = new static(...$args);
    }

    public static function instance(): static
    {
        return static::$instance;
    }
}
