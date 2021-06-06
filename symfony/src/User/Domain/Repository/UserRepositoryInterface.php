<?php

namespace App\User\Domain\Repository;

use App\User\Domain\Model\Collection\UserCollection;
use App\User\Domain\Model\User;
use App\User\Domain\Repository\Exception\EntityNotFoundException;
use App\User\Domain\ValueObject\UserId;

interface UserRepositoryInterface
{
    /**
     * @throws EntityNotFoundException
     */
    public function find(UserId $userId): User;

    public function findAll(): UserCollection;

    public function add(User $user): void;

    public function remove(User $user): void;
}
