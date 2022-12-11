<?php

declare(strict_types=1);

namespace App\Src\Model;

use App\Src\Model\AbstractModel;
use App\Src\Model\ModelInterface;

class UserModel extends AbstractModel implements ModelInterface
{
    const NAME = 'user';
    const COLUMNS = [
        'id',
        'username',
        'email',
        'password'
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
            self::NAME, [
                self::USERNAME,
                self::EMAIL,
                self::PASSWORD
            ],
            [
                $data['username'],
                $data['email'],
                $data['password']
            ]
        );
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