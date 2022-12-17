<?php

declare(strict_types=1);

namespace App\Src\Builder;

interface BuilderInterface
{
    public static function create(string $file, array $param);
}