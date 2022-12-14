<?php

declare(strict_types=1);

namespace App\Src;

use App\Src\Builder\AbstractBuilder;

class Router extends AbstractBuilder
{
    public static function route(string $uri, string $file, array $params = null): void
    {
        $userUri = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);

        $path = '/agd_w_czystym/index.php';
        if ($userUri !== $path . $uri)
            return;

        $view = AbstractBuilder::fileToString('pages/' . $file);

        if ($params !== null)
            $view = AbstractBuilder::implementParam($params, $view);

        $layout = AbstractBuilder::fileToString('layout');

        print AbstractBuilder::implementParam(['pagePosition' => $view], $layout);
    }
}