<?php

declare(strict_types=1);

namespace App\Src\Model;

interface ModelInterface
{
    const NAME = '';
    const COLUMNS = [];

    public function create(array $data): void;
    public function get(int $id): array;
    public function update(int $id, array $data): void;
    public function delete(int $id): void;
}