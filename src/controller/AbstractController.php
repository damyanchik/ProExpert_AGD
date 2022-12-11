<?php

declare(strict_types=1);

namespace App\Src\Controller;

abstract class AbstractController
{
    protected function redirect(string $page): void
    {
        header("Location:/agd_w_czystym/index.php$page");
    }
}