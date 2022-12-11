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
            'login' => Request::post('regLogin'),
            'email' => Request::post('regEmail'),
            'password' => Request::post('regPassword')
        ]);

        $this->redirect('/');
    }

    private function validateRegistration(): bool
    {
        if (
            !Request::isPost('registration')
            || Request::emptyPost('regEmail')
            || !Validation::validateUsername(Request::post('regLogin'))
            || !Validation::validatePassword(Request::post('regPassword'))
            || $this->userModel->find(
                'login',
                Request::post('regLogin')
            )
            || $this->userModel->find(
                'email',
                Request::post('regEmail')
            )
        )
            return false;

        return true;
    }

    public function render():void
    {
        Router::route('/registration', 'registration');
    }
}