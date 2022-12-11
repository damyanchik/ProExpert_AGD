<?php

declare(strict_types=1);

namespace App\Src\Controller;

use App\Src\Helper\Request;
use App\Src\Model\UserModel;
use App\Src\Router;
use App\Src\Helper\Validation;

class LoginController extends AbstractController
{
    protected object $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();

        $this->loginUser();
        $this->logoutUser();
        $this->render();
    }

    public function loginUser(): void
    {
        if (!self::validateLogin())
            return;

        if (!self::dataVerification())
            return;

        $_SESSION['user'] = Request::post('login');
        $this->redirect('/admin');
    }

    public function logoutUser(): void
    {
        if (!isset($_SESSION['user']) && !Request::isGet('logout'))
            return;

        session_destroy();
        $this->redirect('/');
    }

    private function dataVerification(): bool
    {

        $checkPass = $this->userModel->find(
            'login',
            Request::post('login'));

        if ($checkPass == null)
            return false;

        if ($checkPass[0]['user_password'] != md5(Request::post('password')))
            return false;

        return true;
    }

    private function validateLogin(): bool
    {
        if (
            isset($_SESSION['user'])
            || Request::isPost('authorisation')
            || Request::emptyPost('password')
            || Request::emptyPost('login')
            || !Validation::validateUsername(Request::post('login'))
            || !Validation::validatePassword(Request::post('password'))
        )
            return false;

        return true;
    }

    public function render(): void
    {
        Router::route('/login', 'login');
    }
}