<?php

declare(strict_types=1);

namespace App\Src\Controller;

use App\Src\Model\UserModel;
use App\Src\Router;
use App\Src\Helper\Request;
use App\Src\Helper\Validation;

class RegistrationController extends AbstractController
{
    protected object $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();

        $this->registerUser();
        $this->render();
    }

    public function registerUser(): void
    {
        if (!$this->validateRegistration())
            return;

        $this->userModel->create([
            'username' => Request::post('regUsername'),
            'email' => Request::post('regEmail'),
            'password' => Request::post('regPassword')
        ]);

        $this->redirect('/');
    }

    private function validateRegistration(): bool
    {
        if (
            !Request::isPost('registration')
            || !Validation::validateEmail(Request::post('regEmail'))
            || !Validation::validateUsername(Request::post('regUsername'))
            || !Validation::validatePassword(Request::post('regPassword'))
            || $this->findMatches()
        )
            return false;

        return true;
    }

    private function findMatches(): bool
    {
        if (
            $this->userModel->find(
                'username',
                Request::post('regUsername')
            )
            || $this->userModel->find(
                'email',
                Request::post('regEmail')
            )
        )
            return true;

        return false;
    }

    public function render(): void
    {
        Router::route('/registration', 'registration');
    }
}