<?php

declare(strict_types=1);

namespace App\Src\Controller;

use App\Src\Controller\AbstractController;
use App\Src\Request;
use App\Src\Validation;

class LoginController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();
        $this->loginUser();
        $this->logoutUser();
    }

    public function loginUser(): void
    {
        if (
            isset($_SESSION['user'])
            || !Request::isPost('authorization')
            || Request::emptyPost('login')
            || Request::emptyPost('password')
            || !Validation::validateUsername(Request::post('login'))
            || !Validation::validatePassword(Request::post('password'))
        )
            return;

        $dbPassword = $this->db->getRecord(
            \UserTab::NAME,
            \UserTab::LOGIN_COLUMN,
            Request::post('login')
        );

        if ($dbPassword[0]['user_password'] != md5(Request::post('password')))
            return;

        $_SESSION['user'] = Request::post('login');
        $this->redirect('admin');
    }

    public function logoutUser(): void
    {
        if (isset($_SESSION['user']) && Request::isGet('logout')) {
            session_destroy();
            $this->redirect('home');
        }
    }
}