<?php

declare(strict_types=1);

namespace App\Src\Controller\Admin;

use App\Src\Builder\AdditionBuilder;
use App\Src\Controller\AbstractController;
use App\Src\Router;

class AdminController extends AbstractController
{
    protected string $uri = '/admin';

    protected function render(): void
    {
        $panel = AdditionBuilder::create(
            'additions\panel', [
            'adminActive' => 'active',
            'user' => $_SESSION['user']
        ]);

        Router::route(
            $this->uri,
            'admin/admin', [
            'panel' => $panel
        ]);
    }
}