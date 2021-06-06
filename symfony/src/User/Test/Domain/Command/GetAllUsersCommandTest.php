<?php

namespace App\User\Test\Domain\Command;

use App\User\Domain\Command\GetAllUsersCommand;
use App\User\Infrastructure\Repository\InMemory\InMemoryUserRepository;
use PHPUnit\Framework\TestCase;

class GetAllUsersCommandTest extends TestCase
{
    public function testGetAllUsersExecute()
    {
        $getAllUsersCommand = new GetAllUsersCommand(
            new InMemoryUserRepository()
        );

        $userCollection = $getAllUsersCommand->execute();

        $this->assertCount(2, $userCollection);
    }
}
