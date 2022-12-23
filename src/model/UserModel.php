<?php

declare(strict_types=1);

namespace App\Src\Model;

use App\Src\Model\AbstractModel;
use App\Src\Model\ModelInterface;

class UserModel extends AbstractModel implements ModelInterface
{
    const NAME = 'user';
    const COLUMNS = [
        'username',
        'email',
        'password',
        'status'
    ];
    const ID = 'id';
    const USERNAME = 'username';
    const EMAIL = 'email';
    const PASSWORD = 'password';
    const STATUS = 'status';

    public function create(array $data): void
    {
        $data['password'] = md5($data['password']);

        $this->addRecord(
            self::NAME,
            self::COLUMNS,
            [
                $data['username'],
                $data['email'],
                $data['password'],
                $data['status']
            ]
        );
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
            self::COLUMNS,
            [
                $data['username'],
                $data['email'],
                $data['password'],
                $data['status']
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

    public function find(string $column, string $search): array
    {
        return $this->getRecord(
            self::NAME,
            $column,
            $search
        );
    }

}