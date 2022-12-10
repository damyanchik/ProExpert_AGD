<?php

declare(strict_types=1);

namespace App\Src\Helper;

class Request
{
    public static function post($key, $trim = false): mixed
    {
        if (!isset($_POST[$key]))
            return NULL;

        return ($trim) ? trim(strip_tags($_POST[$key])) : $_POST[$key];
    }

    public static function isPost($key): bool
    {
        if (!isset($_POST[$key]))
            return false;
        else
            return true;
    }

    public static function emptyPost($key): bool
    {
        if (!empty($_POST[$key]))
            return false;
        else
            return true;
    }

    public static function get($key, $trim = false): mixed
    {
        if (!isset($_GET[$key]))
            return NULL;

        return ($trim) ? trim(strip_tags($_GET[$key])) : $_GET[$key];
    }

    public static function isGet($key): bool
    {
        if (!isset($_GET[$key]))
            return false;
        else
            return true;
    }

    public static function emptyGet($key): bool
    {
        if (!empty($_GET[$key]))
            return false;
        else
            return true;
    }
}