<?php

declare(strict_types=1);

namespace App\Src\Controller;

use App\Src\Controller\AbstractController;
use App\Src\Request;
use App\Src\Validation;

class RegistrationController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();
        $this->registerUser();
    }

    public function registerUser(): void
    {
        if (
            !isset($_SESSION['user'])
            || !Request::isPost('registration')
            || Request::emptyPost('regLogin')
            || Request::emptyPost('regEmail')
            || Request::emptyPost('regPassword')
            || !Validation::validateUsername(Request::post('regLogin'))
            || !Validation::validatePassword(Request::post('regPassword'))
            || $this->db->getRecord(
                \UserTab::NAME,
                \UserTab::LOGIN_COLUMN,
                Request::post('regLogin')
            )
            || $this->db->getRecord(
                \UserTab::NAME,
                \UserTab::EMAIL_COLUMN,
                Request::post('regEmail')
            )
        )
            return;

        $cryptPassword = md5(Request::post('regPassword'));

        $this->db->addRecord(
            \UserTab::NAME, [
                \UserTab::LOGIN_COLUMN,
                \UserTab::EMAIL_COLUMN,
                \UserTab::PASSWORD_COLUMN
        ],
            [
                Request::post('regLogin'),
                Request::post('regEmail'),
                $cryptPassword
        ]);

        $this->redirect('registration');
    }
}