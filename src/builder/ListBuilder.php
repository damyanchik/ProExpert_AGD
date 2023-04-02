<?php

declare(strict_types=1);

namespace App\Src\Builder;

class ListBuilder extends AbstractBuilder implements BuilderInterface
{
    public static function create(string $file, array $param): string
    {
        $pattern = AbstractBuilder::fileToString($file);

        return self::construct($param, $pattern);
    }

    private static function construct(array $list, string $pattern): string
    {
        $view = '';

        for ($i = 0; $i < count($list); $i++) {
            $view .= AbstractBuilder::implementParam($list[$i], $pattern);
        }

        return $view;
    }

    public static function modify(array &$list, array $keys, array $values, array $conditions = null): array
    {
        for ($n = 0; $n < count($keys); $n++) {
            for ($i = 0; $i < count($list); $i++) {
                if ($conditions != null && $list[$i][$keys[$n]] != $conditions[$values[$n]]) {
                    continue;
                } else {
                    $list[$i][$keys[$n]] = $values[$n];
                }
            }
        }

        return $list;
    }
}