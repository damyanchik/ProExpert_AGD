<?php

declare(strict_types=1);

namespace App\Src\Controller\Admin;

use App\Src\Builder\AdditionBuilder;
use App\Src\Builder\ListBuilder;
use App\Src\Controller\AbstractController;
use App\Src\Helper\Request;
use App\Src\Helper\Validation;
use App\Src\Model\UserModel;
use App\Src\Router;

class AccountController extends AbstractController
{
    protected function render(): void
    {
        $panel = AdditionBuilder::create(
            'additions\panel', [
            'accountActive' => 'active',
            'user' => $_SESSION['user']
        ]);

        $this->setEmail();
        $this->setPassword();
        $this->setStatus();
        $this->userList();

        Router::route(
            '/account',
            'admin/account', [
                'panel' => $panel,
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
            ['moderator', 'administrator'],
            ['moderator' => 1, 'administrator' => '-1']
        );

        return ListBuilder::create('lists\account\users', $list);
    }

    private function setEmail(): void
    {
        if (
            Request::post('userId') == null
            || !Validation::validateEmail(
                Request::post('email'
                )
            )
        )
            return;

        $user = new UserModel();
        $user->updateSingle(
            intval(Request::post('userId')),
            'email',
            Request::post('email')
        );
    }

    private function setPassword(): void
    {
        if (
            Request::post('userId') == null
            || !Validation::validatePassword(
                Request::post('password')
            )
        )
            return;

        $encryptedPass = md5(Request::post('password'));
        $user = new UserModel();
        $user->updateSingle(
            intval(Request::post('userId')),
            'password',
            $encryptedPass
        );
    }

    private function setStatus(): void
    {
        if (
            !Request::isPost('status')
            || Request::post('userId') == null
        )
            return;

        $oppositeStatus = ['administrator' => 1, 'moderator' => -1];

        $statusId = $oppositeStatus[Request::post('status')];

        $user = new UserModel();
        $user->updateSingle(
            intval(Request::post('userId')),
            'status',
            $statusId
        );
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