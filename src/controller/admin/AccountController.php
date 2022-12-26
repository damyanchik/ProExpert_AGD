<?php

declare(strict_types=1);

namespace App\Src\Controller\Admin;

use App\Src\Builder\AdditionBuilder;
use App\Src\Builder\ListBuilder;
use App\Src\Controller\AbstractController;
use App\Src\Helper\Request;
use App\Src\Model\UserModel;
use App\Src\Router;

class AccountController extends AbstractController
{
    protected function render(): void
    {
        $this->userList();
        Router::route(
            '/account',
            'admin/account', [
                'panel' => AdditionBuilder::create(
                    'additions\panel', [
                        'accountActive' => 'active',
                        'user' => $_SESSION['user']
                ]),
                'list' => $this->userList()
        ]);
        $this->deleteUser();
    }

    private function userList(): string
    {
        $user = new UserModel();
        $list = $user->get();

        $list = ListBuilder::modify(
            $list,
            ['status', 'status'],
            ['moderator', 'admin'],
            ['moderator' => 1, 'admin' => '-1']
        );

        return ListBuilder::create('lists\account\users', $list);
    }

    private function deleteUser(): void
    {
        if (!Request::get('delId') || Request::emptyGet('delId'))
            return;

        $user = new UserModel();
        $user->delete(intval(Request::get('delId')));
        $this->redirectToPage('/account');
    }
}