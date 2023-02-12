<?php

declare(strict_types=1);

namespace App\Src\Controller;

use App\Src\Router;

class CoverageController extends AbstractController
{
    protected string $uri = '/coverage';

    protected function render(): void
    {
        Router::route($this->uri, 'coverage');
    }
}