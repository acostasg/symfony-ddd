<?php

namespace App\User\Domain\Repository;

use App\User\Domain\Model\Collection\UserCollection;
use App\User\Domain\Model\User;
use App\User\Domain\Repository\Exception\EntityNotFoundException;
use App\User\Domain\Repository\Exception\ErrorPersistEntityException;
use App\User\Domain\Repository\Exception\ErrorRemoveEntityException;
use App\User\Domain\ValueObject\UserId;

interface UserRepositoryInterface
{
    /**
     * @throws EntityNotFoundException
     */
    public function user(UserId $userId): User;

    public function all(): UserCollection;

    /**
     * @throws ErrorPersistEntityException
     */
    public function add(User $user): void;

    /**
     * @throws ErrorRemoveEntityException
     */
    public function remove(User $user): void;
}
