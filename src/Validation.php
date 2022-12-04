<?php

declare(strict_types=1);

namespace App\Src;

class Validation
{
    public static function validateUsername(string $username): bool
    {
        if (
            !preg_match("/^[a-zA-z0-9]*$/", $username)
            || strlen($username) < 3
            || strlen($username) > 20
        )
            return false;
        else
            return true;
    }

    public static function validatePassword(string $password): bool
    {
        if (strlen($password) < 5 || strlen($password) > 17)
            return false;
        else
            return true;
    }
}