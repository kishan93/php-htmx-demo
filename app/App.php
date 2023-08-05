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

    public function setContent(string $content)
    {
        $this->content = $content;
    }

    public function render()
    {
        return $this->content;
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
