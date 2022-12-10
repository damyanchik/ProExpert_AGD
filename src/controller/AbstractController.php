<?php

declare(strict_types=1);

namespace App\Src\Controller;

use App\Src\Helper\Database;

abstract class AbstractController
{
    protected object $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    protected function redirect(string $page): void
    {
        header("Location:/agd_w_czystym/index.php$page");
    }
}