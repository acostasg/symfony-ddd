<?php

namespace App\User\Infrastructure\Repository\InMemory;

use App\User\Domain\Model\Collection\UserCollection;
use App\User\Domain\Model\User;
use App\User\Domain\Repository\Exception\EntityNotFoundException;
use App\User\Domain\Repository\UserRepositoryInterface;
use App\User\Domain\ValueObject\UserId;

class InMemoryUserRepository implements UserRepositoryInterface
{
    private UserCollection $users;

    /**
     * InMemoryUserRepository constructor.
     */
    public function __construct()
    {
        $this->users = new UserCollection();
        $this->users->add(
            new User(
                new UserId('8CE05088-ED1F-43E9-A415-3B3792655A9B'),
                'John',
                'Doe'
            )
        );
        $this->users->add(
            new User(
                new UserId('62A0CEB4-0403-4AA6-A6CD-1EE808AD4D23'),
                'Jean',
                'Bon'
            )
        );
    }

    /**
     * @throws EntityNotFoundException
     */
    public function user(UserId $userId): User
    {
        foreach ($this->users as $user) {
            if ($user->getId()->getValue() == $userId->getValue()) {
                return $user;
            }
        }
        throw new EntityNotFoundException();
    }

    public function all(): UserCollection
    {
        return $this->users;
    }

    public function add(User $user): void
    {
        $this->users->add($user);
    }

    public function remove(User $user): void
    {
        $this->users->remove($user);
    }
}
