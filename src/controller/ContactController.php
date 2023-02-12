<?php

declare(strict_types=1);

namespace App\Src\Controller;

use App\Src\Router;

class ContactController extends AbstractController
{
    protected string $uri = '/contact';

    protected function render(): void
    {
        Router::route($this->uri, 'contact');
    }

}