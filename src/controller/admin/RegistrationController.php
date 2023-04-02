<?php

declare(strict_types=1);

namespace App\Src\Controller\Admin;

use App\Src\Model\UserModel;
use App\Src\Router;
use App\Src\Helper\Request;
use App\Src\Helper\Validation;
use App\Src\Controller\AbstractController;

class RegistrationController extends AbstractController
{
    protected object $userModel;
    protected string $uri = '/registration';

    public function __construct()
    {
        $this->userModel = new UserModel();
        parent::__construct();
    }

    protected function render(): void
    {
        $this->access(['admin'], '/login');

        $this->registerUser();
        Router::route($this->uri, 'admin/registration');
    }

    private function registerUser(): void
    {
        if (!$this->validateRegistration())
            return;

        $this->userModel->create([
            'username' => Request::post('regUsername'),
            'email' => Request::post('regEmail'),
            'password' => Request::post('regPassword'),
            'status' => 1
        ]);

        $this->redirectToPage('/account');
    }

    private function validateRegistration(): bool
    {
        if (
            !Request::isPost('registration')
            || !Validation::validateEmail(Request::post('regEmail'))
            || !Validation::validateUsername(Request::post('regUsername'))
            || !Validation::validatePassword(Request::post('regPassword'))
            || $this->findMatch()
        )
            return false;

        return true;
    }

    private function findMatch(): bool
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
}