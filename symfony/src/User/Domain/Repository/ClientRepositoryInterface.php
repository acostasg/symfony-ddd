<?php

namespace App\User\Domain\Repository;

use App\User\Domain\Model\Client;
use App\User\Domain\Model\Collection\ClientCollection;
use App\User\Domain\Repository\Exception\EntityNotFoundException;
use App\User\Domain\ValueObject\UserId;

interface ClientRepositoryInterface
{
    /**
     * @throws EntityNotFoundException
     */
    public function find(UserId $userId): Client;

    public function findAll(): ClientCollection;

    public function add(Client $user): void;

    public function remove(Client $user): void;
}
