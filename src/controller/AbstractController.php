<?php

declare(strict_types=1);

namespace App\Src\Controller;

use App\Src\Router;

abstract class AbstractController
{
    protected string $uri = '';

    public function __construct()
    {
        if (Router::isUrl($this->uri) || $this->uri === '')
            $this->render();
    }

    protected function access(array $status, string $page): void
    {
        if (in_array($_SESSION['status'], $status))
            return;

        $this->redirectToPage($page);
    }

    protected function redirectToPage(string $page): void
    {
        header("Location:/agd_w_czystym/index.php$page");
    }

    protected function redirectToUrl(string $link): void
    {
        header("Location: $link");
        die();
    }

    protected function render(): void
    {
    }
}