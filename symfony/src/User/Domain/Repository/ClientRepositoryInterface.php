<?php

namespace App\User\Domain\Repository;

use App\User\Domain\Model\Client;
use App\User\Domain\Model\Collection\ClientCollection;
use App\User\Domain\Repository\Exception\EntityNotFoundException;
use App\User\Domain\Repository\Exception\ErrorPersistEntityException;
use App\User\Domain\Repository\Exception\ErrorRemoveEntityException;
use App\User\Domain\ValueObject\UserId;

interface ClientRepositoryInterface
{
    /**
     * @throws EntityNotFoundException
     */
    public function client(UserId $userId): Client;

    public function all(): ClientCollection;

    /**
     * @throws ErrorPersistEntityException
     */
    public function add(Client $client): void;

    /**
     * @throws ErrorRemoveEntityException
     */
    public function remove(Client $client): void;
}
