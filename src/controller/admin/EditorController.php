<?php

declare(strict_types=1);

namespace App\Src\Controller\Admin;

use App\Src\Controller\AbstractController;
use App\Src\Router;

class EditorController extends AbstractController
{
    protected function render(): void
    {
        Router::route('/editor', 'editor');
    }
}