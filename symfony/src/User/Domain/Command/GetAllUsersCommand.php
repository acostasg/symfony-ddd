<?php

namespace App\User\Domain\Command;

use App\Core\Domain\Command\CommandInterface;
use App\User\Domain\Model\Collection\UserCollection;
use App\User\Domain\Repository\UserRepositoryInterface;

class GetAllUsersCommand implements CommandInterface
{
    private UserRepositoryInterface $userRepository;

    /**
     * GetAllUsersCommand constructor.
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(): UserCollection
    {
        return $this->userRepository->all();
    }
}
