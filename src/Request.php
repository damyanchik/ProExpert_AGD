<?php

declare(strict_types=1);

namespace App\Src;

class Request
{
    public static function post($key, $trim = false): mixed
    {
        if (isset($_POST[$key]))
            return ($trim) ? trim(strip_tags($_POST[$key])) : $_POST[$key];

        return NULL;
    }

    public static function isPost($key): bool
    {
        if (isset($_POST[$key]))
            return true;
        else
            return false;
    }

    public static function emptyPost($key): bool
    {
        if (empty($_POST[$key]))
            return true;
        else
            return false;
    }

    public static function get($key, $trim = false): mixed
    {
        if (isset($_GET[$key]))
            return ($trim) ? trim(strip_tags($_GET[$key])) : $_GET[$key];
        else
            return NULL;
    }

    public static function isGet($key): bool
    {
        if (isset($_GET[$key]))
            return true;
        else
            return false;
    }

    public static function emptyGet($key): bool
    {
        if (isset($_GET[$key]) && empty($_GET[$key]))
            return true;
        else
            return false;
    }
}