<?php

namespace App;

use App\Exceptions\ViewNotFoundException;

class View
{
    public function __construct(protected string $view, protected array $params=[])
    {
    }

    public static function make(...$args): static
    {
        return new static(...$args);
    }

    public function __toString()
    {
        return $this->render();
    }

    public function render(): string
    {
        $file = VIEW_PATH . $this->view;

        if(!file_exists($file)){
            throw new ViewNotFoundException($this->view);
        }

        ob_start();
        include $file;
        return ob_get_clean();
    }
}
