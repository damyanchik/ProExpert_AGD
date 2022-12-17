<?php

declare(strict_types=1);

namespace App\Src\Controller;

use App\Src\Router;

class AboutController extends AbstractController
{
    protected function render(): void
    {
        Router::route('/about', 'about');
    }

}