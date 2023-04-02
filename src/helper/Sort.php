<?php

declare(strict_types=1);

namespace App\Src\Helper;

class Sort
{
    public static function sortArray(array &$array, string $column, string $order = null): array
    {
        if (!$column)
            return $array;

        usort($array, function($a, $b) use ($column) {
            return strcmp($a[$column], $b[$column]);
        });

        if ($order == 'desc')
            $array = array_reverse($array);

        return $array;
    }
}