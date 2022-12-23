<?php

declare(strict_types=1);

namespace App\Src\Model;

use App\Src\Model\AbstractModel;
use App\Src\Model\ModelInterface;

class ContentModel extends AbstractModel implements ModelInterface
{
    const NAME = 'content';
    const COLUMNS = [
        'page',
        'text',
        'date',
    ];
    const ID = 'id';
    const PAGE = 'page';
    const TEXT = 'text';
    const DATE = 'date';

    public function create(array $data): void
    {
    }

    public function get(int $id): array
    {
        return $this->getRecord(
            self::NAME,
            self::ID,
            $id
        );
    }

    public function update(int $id, array $data): void
    {
        $this->editRecord(
            self::NAME,
            self::COLUMNS,
            [
                $data['page'],
                $data['text'],
                $data['date']
            ],
            self::ID,
            $id
        );
    }

    public function delete(int $id): void
    {
        $this->deleteRecord(
            self::NAME,
            self::ID,
            $id
        );
    }
}