<?php

declare(strict_types=1);

namespace App\Src\Builder;

class AdditionBuilder extends AbstractBuilder implements BuilderInterface
{
    public static function create(string $file, array $param): string
    {
        $pattern = AbstractBuilder::fileToString($file);

        return AbstractBuilder::implementParam($param, $pattern);
    }
}