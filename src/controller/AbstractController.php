<?php

declare(strict_types=1);

namespace App\Src\Controller;

use App\Src\Database;

abstract class AbstractController
{
    protected object $db;

    abstract function render(): void;

    public function __construct()
    {
        $this->db = new Database();
    }

    protected function redirect(string $page): void
    {
        header("Location:index.php?page=$page");
    }

}