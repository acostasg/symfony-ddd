<?php

namespace App\User\Domain\Model\Factory;

use App\User\Domain\Model\Client;
use App\User\Domain\Model\User;
use App\User\Domain\ValueObject\UserId;

class ClientFactory
{
    public static function build(UserId $userId, string $firstName, string $lastName, string $email): Client
    {
        return new Client(
            new User(
                $userId,
                $firstName,
                $lastName
            ),
            $email
        );
    }
}
