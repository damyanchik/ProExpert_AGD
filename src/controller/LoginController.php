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
        if (!empty($_SESSION['status']) && Router::isUrl('/login')) {
            $this->redirectToPage('/admin');
            return;
        }

        $this->loginUser();
        $this->logoutUser();
        Router::route('/login', 'login');
    }

    private function loginUser(): void
    {
        if (!self::validateLogin())
            return;

        if (!self::dataVerification())
            return;
        else
            $status = self::dataVerification();

        $_SESSION['user'] = Request::post('username');
        $this->setStatus($status);
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

    private function dataVerification(): null|int
    {
        $userModel = new UserModel();

        $userData = $userModel->find(
            'username',
            Request::post('username')
        );

        if (!$userData)
            return null;

        if ($userData[0]['password'] != md5(Request::post('password'))) {
            $userModel->updateSingle(
                $userData[0]['id'] ,
                'incorrect_login',
                date('Y-m-d H:i:s')
            );
            return null;
        }

        $userModel->updateSingle(
            $userData[0]['id'] ,
            'last_login',
            date('Y-m-d H:i:s'));

        return $userData[0]['status'];
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

    private function setStatus($status): void
    {
        if ($status == '-1')
            $_SESSION['status'] = 'admin';
        elseif ($status == '1')
            $_SESSION['status'] = 'moderator';
        else
            return;
    }
}