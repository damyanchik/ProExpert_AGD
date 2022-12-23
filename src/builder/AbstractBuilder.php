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

    protected static function implementParam(array $replace, string $pattern, bool $isList = false): string
    {
        $view = '';
        $loop = $pattern;

        if ($isList) {
           for ($i = 0; $i < count($replace); $i++) {
               foreach ($replace[$i] as $search => $change) {
                   var_dump($change);
                   $loop = str_replace('[%' . $search . '%]', strval($change), $loop);
               }
               $view .= $loop;
               $loop = $pattern;
               var_dump($view);
           }
        } else {
            foreach ($replace as $search => $change)
                $view = str_replace('[%' . $search . '%]', strval($change), $pattern);
        }

        return $view;
    }
}