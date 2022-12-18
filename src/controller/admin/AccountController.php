<?php

declare(strict_types=1);

namespace App\Src\Controller\Admin;

use App\Src\Builder\AdditionBuilder;
use App\Src\Controller\AbstractController;
use App\Src\Router;

class AccountController extends AbstractController
{
    protected function render(): void
    {
        Router::route(
            '/account',
            'admin/account', [
                'panel' => AdditionBuilder::create(
                    'additions\panel',
                    ['panel']
                )
        ]);
    }
}