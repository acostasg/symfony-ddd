<?php

namespace App\User\Test\Domain\Command;

use App\User\Domain\Command\GetAllClientsCommand;
use App\User\Infrastructure\Repository\InMemory\InMemoryClientRepository;
use PHPUnit\Framework\TestCase;

class GetAllClientsCommandTest extends TestCase
{
    /** @group userBundle */
    public function testGetAllClient(): void
    {
        $getAllClientsCommand = new GetAllClientsCommand(
            new InMemoryClientRepository()
        );

        $clientCollection = $getAllClientsCommand->execute();

        $this->assertCount(2, $clientCollection);
    }
}
