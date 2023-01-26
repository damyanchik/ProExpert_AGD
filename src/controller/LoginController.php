<?php

declare(strict_types=1);

namespace App\Src\Controller;

use App\Src\Helper\Request;
use App\Src\Model\UserModel;
use App\Src\Helper\Validation;
use App\Src\Router;

class LoginController extends AbstractController
{

    protected function render(): void
    {
        $this->loginUser();
        $this->logoutUser();
        Router::route('/login', 'login');
    }

    private function loginUser(): void
    {
        if (
            !self::validateLogin()
            || !self::dataVerification()
        )
            return;

        $_SESSION['user'] = Request::post('username');
        $this->redirectToPage('/admin');
    }

    private function logoutUser(): void
    {
        if (
            !isset($_SESSION['user'])
            || !Request::isGet('logout')
        )
            return;

        session_destroy();
        $this->redirectToPage('/');
    }

    private function dataVerification(): bool
    {
        $userModel = new UserModel();

        $userData = $userModel->find(
            'username',
            Request::post('username')
        );

        if ($userData == null)
            return false;

        if ($userData[0]['password'] != md5(Request::post('password'))) {
            $userModel->updateSingle(
                $userData[0]['id'] ,
                'incorrect_login',
                date('Y-m-d H:i:s')
            );
            return false;
        }

        $userModel->updateSingle(
            $userData[0]['id'] ,
            'last_login',
            date('Y-m-d H:i:s'));

        return true;
    }

    private function validateLogin(): bool
    {
        if (
            isset($_SESSION['user'])
            || Request::isPost('authorisation')
            || Request::emptyPost('password')
            || Request::emptyPost('username')
            || !Validation::validateUsername(Request::post('username'))
            || !Validation::validatePassword(Request::post('password'))
        )
            return false;

        return true;
    }
}