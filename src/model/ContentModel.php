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
        'description',
        'text',
        'date',
    ];
    const ID = 'id';
    const PAGE = 'page';
    const DESCRIPTION = 'description';
    const TEXT = 'text';
    const DATE = 'date';

    const HOME = 1;
    const ABOUT = 2;
    const COVERAGE = 3;
    const CONTACT = 4;

    public function create(array $data): void
    {
    }

    public function get(int $id = null): array
    {
        if ($id !== null)
            return $this->getRecord(
                self::NAME,
                self::ID,
                $id
            );
        else
            return $this->getRecord(
                self::NAME
            );
    }

    public function update(int $id, array $data): void
    {
        $this->editRecord(
            self::NAME,
            [
                self::TEXT,
                self::DATE
            ],
            [
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

    public function getByPage(int $pageId): array
    {
        return $this->getRecord(
            self::NAME,
            self::PAGE,
            $pageId
        );
    }
}