<?php

declare(strict_types=1);

namespace App\Src\Controller;

use App\Src\Router;

class CoverageController extends AbstractController
{
    public function __construct()
    {
        $this->render();
    }

    private function render(): void
    {
        Router::route('/coverage', 'coverage');
    }

}