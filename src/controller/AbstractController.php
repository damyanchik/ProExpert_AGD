<?php

declare(strict_types=1);

namespace App\Src\Controller;

use App\Src\Database;

class AbstractController
{
    protected object $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}