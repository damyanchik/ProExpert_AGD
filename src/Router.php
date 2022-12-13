<?php

declare(strict_types=1);

namespace App\Src;

class Router
{
    public static function route(string $uri, string $template, array $params = null): void
    {
        $userUri = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);

        $path = '/agd_w_czystym/index.php';
        if ($userUri !== $path . $uri)
            return;

        if (!$template)
            return;

        $view = self::loadTemplate('pages/' . $template);

        if ($params !== null)
            $view = self::implementParam($params, $view);

        $layout = self::loadTemplate('layout');

        print self::implementParam(['pagePlace' => $view], $layout);
    }

    private static function loadTemplate(string $fileDirection): null|string
    {
        if (
            $fileDirection === null
            && !file_exists(__DIR__ . '../templates/pages' . $fileDirection . '.php')
        )
            return null;

        ob_start();
        include(__DIR__ . '\..\templates\\' . $fileDirection . '.html');
        $view = ob_get_clean();

        return $view;
    }

    private static function implementParam(array $replace, string $template): null|string
    {
        foreach ($replace as $search => $change)
            $view = str_replace('[%' . $search . '%]', $change, $template);

        return $view;
    }
}