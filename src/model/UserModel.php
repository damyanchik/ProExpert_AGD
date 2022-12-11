<?php

declare(strict_types=1);

namespace App\Src\Model;

use App\Src\Model\AbstractModel;
use App\Src\Model\ModelInterface;

class UserModel extends AbstractModel implements ModelInterface
{
    const NAME = 'usertab';
    const COLUMNS = [
        'user_id',
        'user_login',
        'user_email',
        'user_password'
    ];
    const ID_COLUMN = 'user_id';
    const LOGIN_COLUMN = 'user_login';
    const EMAIL_COLUMN = 'user_email';
    const PASSWORD_COLUMN = 'user_password';
    const STATUS_COLUMN = 'user_status';

    public function create(array $data): void
    {
        $data['password'] = md5($data['password']);

        $this->addRecord(
            self::NAME, [
                self::LOGIN_COLUMN,
                self::EMAIL_COLUMN,
                self::PASSWORD_COLUMN
            ],
            [
                $data['login'],
                $data['email'],
                $data['password']
            ]
        );
    }

    public function get(int $id): array
    {
        return $this->getRecord(
            self::NAME,
            self::ID_COLUMN,
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
            self::ID_COLUMN,
            $id
        );
    }

    public function find(string $column, string $search): array
    {
        $name = array_map(
            fn($columns): string =>
            str_replace(
                'user_',
                '',
                $columns
            ),
            self::COLUMNS
        );

        $nameId = array_search($column, $name);

        return $this->getRecord(
            self::NAME,
            self::COLUMNS[$nameId],
            $search
        );
    }

}