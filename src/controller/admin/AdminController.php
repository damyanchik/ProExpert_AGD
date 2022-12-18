<?php

declare(strict_types=1);

namespace App\Src\Controller\Admin;

use App\Src\Builder\AdditionBuilder;
use App\Src\Controller\AbstractController;
use App\Src\Router;

class AdminController extends AbstractController
{
    protected function render(): void
    {
        Router::route(
            '/admin',
            'admin/admin', [
            'panel' => AdditionBuilder::create(
                'additions\panel',
                ['panel']
            )
        ]);
    }
}