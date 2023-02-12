<?php

declare(strict_types=1);

namespace App\Src\Controller;

use App\Src\Router;

class HomeController extends AbstractController
{
    protected string $uri = '/';

    protected function render(): void
    {
        Router::route($this->uri, 'home');
    }

}