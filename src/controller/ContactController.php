<?php

declare(strict_types=1);

namespace App\Src\Controller;

use App\Src\Router;

class ContactController extends AbstractController
{
    protected function render(): void
    {
        Router::route('/contact', 'contact');
    }

}