<?php

namespace App\User\Test\Infrastructure\Repository\Doctrine;

use App\User\Domain\Model\User;
use App\User\Domain\Repository\Exception\ErrorPersistEntityException;
use App\User\Domain\Repository\Exception\ErrorRemoveEntityException;
use App\User\Domain\ValueObject\UserId;
use App\User\Infrastructure\Repository\Doctrine\Mapping\ClientMapper;
use App\User\Infrastructure\Repository\Doctrine\Mapping\UserMapper;
use App\User\Infrastructure\Repository\Doctrine\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Persisters\Entity\EntityPersister;
use Doctrine\ORM\UnitOfWork;
use Exception;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
    /** @group userBundle */
    public function testGetUser(): void
    {
        $userMapper = $this->getUserMapperForTesting();

        $objectManager = $this->createMock(EntityManagerInterface::class);

        $objectManager->expects($this->once())
            ->method('find')
            ->willReturn($userMapper);

        $metadata = new ClassMetadata(ClientMapper::class);

        $userRepository = new UserRepository($objectManager, $metadata);
        $result = $userRepository->user(new UserId('test'));

        $this->assertEquals($userMapper->getId(), $result->getId()->getValue());
    }

    /** @group userBundle */
    public function testAddUser(): void
    {
        $objectManager = $this->createMock(EntityManagerInterface::class);

        $objectManager->expects($this->once())
            ->method('persist');

        $objectManager->expects($this->once())
            ->method('flush');

        $metadata = new ClassMetadata(UserMapper::class);

        $clientRepository = new UserRepository($objectManager, $metadata);
        $clientRepository->add(
            new User(
                new UserId('Test-1'),
                'Test-N',
                'Test-L'
            )
        );
    }

    /** @group userBundle */
    public function testAddUserWitError(): void
    {
        $this->expectException(ErrorPersistEntityException::class);

        $objectManager = $this->createMock(EntityManagerInterface::class);

        $objectManager->expects($this->once())
            ->method('persist');

        $objectManager->expects($this->once())
            ->method('flush')
            ->willThrowException(new Exception('Error'));

        $metadata = new ClassMetadata(UserMapper::class);

        $clientRepository = new UserRepository($objectManager, $metadata);
        $clientRepository->add(
            new User(
                new UserId('Test-1'),
                'Test-N',
                'Test-L'
            )
        );
    }

    /** @group userBundle */
    public function testGetAllClients(): void
    {
        $userMapper = $this->getUserMapperForTesting();

        $objectManager = $this->createMock(EntityManagerInterface::class);
        $unitOfWork = $this->createMock(UnitOfWork::class);
        $persister = $this->createMock(EntityPersister::class);

        $persister->expects($this->once())
            ->method('loadAll')
            ->willReturn([$userMapper]);

        $unitOfWork->expects($this->once())
            ->method('getEntityPersister')
            ->willReturn($persister);

        $objectManager->expects($this->once())
            ->method('getUnitOfWork')
            ->willReturn($unitOfWork);

        $metadata = new ClassMetadata(UserMapper::class);

        $userRepository = new UserRepository($objectManager, $metadata);
        $userCollection = $userRepository->all();
        $this->assertCount(1, $userCollection);
    }

    /** @group userBundle */
    public function testRemoveClient(): void
    {
        $objectManager = $this->createMock(EntityManagerInterface::class);

        $objectManager->expects($this->once())
            ->method('remove');

        $objectManager->expects($this->once())
            ->method('flush');

        $metadata = new ClassMetadata(UserMapper::class);

        $clientRepository = new UserRepository($objectManager, $metadata);
        $clientRepository->remove(
            new User(
                new UserId('Test-1'),
                'Test-N',
                'Test-L'
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

        $clientRepository = new UserRepository($objectManager, $metadata);
        $clientRepository->remove(
            new User(
                new UserId('Test-1'),
                'Test-N',
                'Test-L'
            )
        );
    }

    private function getUserMapperForTesting(): UserMapper
    {
        return new UserMapper(
            new User(
                new UserId('test-1'),
                'test-F',
                'test-L'
            )
        );
    }
}
