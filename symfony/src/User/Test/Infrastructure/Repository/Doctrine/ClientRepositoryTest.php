<?php

namespace App\User\Test\Infrastructure\Repository\Doctrine;

use _HumbugBoxa991b62ce91e\Nette\Neon\Exception;
use App\User\Domain\Model\Factory\ClientFactory;
use App\User\Domain\Repository\Exception\ErrorPersistEntityException;
use App\User\Domain\Repository\Exception\ErrorRemoveEntityException;
use App\User\Domain\ValueObject\UserId;
use App\User\Infrastructure\Repository\Doctrine\ClientRepository;
use App\User\Infrastructure\Repository\Doctrine\Mapping\ClientMapper;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Persisters\Entity\EntityPersister;
use Doctrine\ORM\UnitOfWork;
use PHPUnit\Framework\TestCase;

class ClientRepositoryTest extends TestCase
{
    /** @group userBundle */
    public function testGetClient(): void
    {
        $clientMapper = $this->getClientMapperForTesting();

        $objectManager = $this->createMock(EntityManagerInterface::class);

        $objectManager->expects($this->once())
            ->method('find')
            ->willReturn($clientMapper);

        $metadata = new ClassMetadata(ClientMapper::class);

        $clientRepository = new ClientRepository($objectManager, $metadata);
        $result = $clientRepository->client(new UserId('test'));

        $this->assertEquals($clientMapper->getId(), $result->getId()->getValue());
    }

    /** @group userBundle */
    public function testAddClient(): void
    {
        $objectManager = $this->createMock(EntityManagerInterface::class);

        $objectManager->expects($this->once())
            ->method('persist');

        $objectManager->expects($this->once())
            ->method('flush');

        $metadata = new ClassMetadata(ClientMapper::class);

        $clientRepository = new ClientRepository($objectManager, $metadata);
        $clientRepository->add(
            ClientFactory::build(
                new UserId('Test-1'),
                'Test-N',
                'Test-L',
                'Test-M'
            )
        );
    }

    /** @group userBundle */
    public function testAddClientWitError(): void
    {
        $this->expectException(ErrorPersistEntityException::class);

        $objectManager = $this->createMock(EntityManagerInterface::class);

        $objectManager->expects($this->once())
            ->method('persist');

        $objectManager->expects($this->once())
            ->method('flush')
            ->willThrowException(new Exception('Error'));

        $metadata = new ClassMetadata(ClientMapper::class);

        $clientRepository = new ClientRepository($objectManager, $metadata);
        $clientRepository->add(
            ClientFactory::build(
                new UserId('Test-1'),
                'Test-N',
                'Test-L',
                'Test-M'
            )
        );
    }

    /** @group userBundle */
    public function testGetAllClients(): void
    {
        $clientMapper = $this->getClientMapperForTesting();

        $objectManager = $this->createMock(EntityManagerInterface::class);
        $unitOfWork = $this->createMock(UnitOfWork::class);
        $persister = $this->createMock(EntityPersister::class);

        $persister->expects($this->once())
            ->method('loadAll')
            ->willReturn([$clientMapper]);

        $unitOfWork->expects($this->once())
            ->method('getEntityPersister')
            ->willReturn($persister);

        $objectManager->expects($this->once())
            ->method('getUnitOfWork')
            ->willReturn($unitOfWork);

        $metadata = new ClassMetadata(ClientMapper::class);

        $clientRepository = new ClientRepository($objectManager, $metadata);
        $clientCollection = $clientRepository->all();
        $this->assertCount(1, $clientCollection);
    }

    /** @group userBundle */
    public function testRemoveClient(): void
    {
        $objectManager = $this->createMock(EntityManagerInterface::class);

        $objectManager->expects($this->once())
            ->method('remove');

        $objectManager->expects($this->once())
            ->method('flush');

        $metadata = new ClassMetadata(ClientMapper::class);

        $clientRepository = new ClientRepository($objectManager, $metadata);
        $clientRepository->remove(
            ClientFactory::build(
                new UserId('Test-1'),
                'Test-N',
                'Test-L',
                'Test-M'
            )
        );
    }

    /** @group userBundle */
    public function testRemoveClientWitError(): void
    {
        $this->expectException(ErrorRemoveEntityException::class);

        $objectManager = $this->createMock(EntityManagerInterface::class);

        $objectManager->expects($this->once())
            ->method('remove');

        $objectManager->expects($this->once())
            ->method('flush')
            ->willThrowException(new Exception('Error'));

        $metadata = new ClassMetadata(ClientMapper::class);

        $clientRepository = new ClientRepository($objectManager, $metadata);
        $clientRepository->remove(
            ClientFactory::build(
                new UserId('Test-1'),
                'Test-N',
                'Test-L',
                'Test-M'
            )
        );
    }

    private function getClientMapperForTesting(): ClientMapper
    {
        return new ClientMapper(
            ClientFactory::build(
                new UserId('test-1'),
                'test-F',
                'test-L',
                'test-M'
            )
        );
    }
}
