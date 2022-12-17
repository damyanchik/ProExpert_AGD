<?php

declare(strict_types=1);

namespace App\Src\Builder;

class AdditionBuilder extends AbstractBuilder implements BuilderInterface
{
    public static function create(string $file, array $param): void
    {
        $pattern = AbstractBuilder::fileToString($file);

        print AbstractBuilder::implementParam($param, $pattern);
    }
}