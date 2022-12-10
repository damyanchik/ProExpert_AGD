<?php

declare(strict_types=1);

namespace App\Src\Controller;

use App\Src\Helper\Request;
use App\Src\Router;
use App\Src\Helper\Validation;

class LoginController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();
        $this->loginUser();
        $this->logoutUser();
        $this->render();
    }

    public function loginUser(): void
    {
        if (!self::validateLogin())
            return;

        if (!self::passwordVerification())
            return;

        $_SESSION['user'] = Request::post('login');
        $this->redirect('/admin');
    }

    public function logoutUser(): void
    {
        if (isset($_SESSION['user']) && Request::isGet('logout')) {
            session_destroy();
            $this->redirect('/');
        }
    }

    private function passwordVerification(): bool
    {
        $dbPassword = $this->db->getRecord(
            \UserTab::NAME,
            \UserTab::LOGIN_COLUMN,
            Request::post('login')
        );

        if ($dbPassword !== null)
            return false;

        if ($dbPassword[0]['user_password'] != md5(Request::post('password')))
            return false;

        return true;
    }

    private function validateLogin(): bool
    {
        if (
            isset($_SESSION['user'])
            || Request::emptyPost('login')
            || Request::emptyPost('password')
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