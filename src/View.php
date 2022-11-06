<?php

declare(strict_types=1);

class View
{
    public function render($page) : void
    {
        require_once ('templates/layout.php');
    }
}