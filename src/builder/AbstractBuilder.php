<?php

declare(strict_types=1);

namespace App\Src\Builder;

abstract class AbstractBuilder
{
    protected static function fileToString(string $file): string
    {
        ob_start();
        include(__DIR__ . '\..\..\templates\\' . $file . '.html');
        $view = ob_get_clean();

        return $view;
    }

    protected static function implementParam(array $replace, string $pattern): string
    {
        $view = '';
        $loop = $pattern;

        foreach ($replace as $search => $change) {
            $loop = str_replace('[%' . $search . '%]', strval($change), $loop);
            $view = $loop;
        }

        return $view;
    }
}