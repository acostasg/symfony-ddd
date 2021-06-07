<?php

namespace App\User\Infrastructure\Repository\Doctrine;

use App\User\Domain\Model\Collection\UserCollection;
use App\User\Domain\Model\User;
use App\User\Domain\Repository\Exception\ErrorPersistEntityException;
use App\User\Domain\Repository\Exception\ErrorRemoveEntityException;
use App\User\Domain\Repository\UserRepositoryInterface;
use App\User\Domain\ValueObject\UserId;
use App\User\Infrastructure\Repository\Doctrine\Mapping\UserMapper;
use Doctrine\ORM\EntityRepository as EntityRepository;

class UserRepository extends EntityRepository implements UserRepositoryInterface
{
    /**
     * @throws ErrorPersistEntityException
     */
    public function add(User $user): void
    {
        try {
            $this->getEntityManager()->persist(
                new UserMapper($user)
            );
            $this->getEntityManager()->flush();
        } catch (\Exception $e) {
            throw new ErrorPersistEntityException($e->getMessage());
        }
    }

    /**
     * @throws ErrorRemoveEntityException
     */
    public function remove(User $user): void
    {
        try {
            $this->getEntityManager()->remove(
                new UserMapper($user)
            );
            $this->getEntityManager()->flush();
        } catch (\Exception $e) {
            throw new ErrorRemoveEntityException($e->getMessage());
        }
    }

    public function user(UserId $userId): User
    {
        $mapper = $this->find($userId->getValue());

        return $mapper->build();
    }

    public function all(): UserCollection
    {
        $array = $this->findBy([], ['firstName' => 'ASC']);

        $userCollection = new UserCollection();
        foreach ($array as $mapper) {
            $userCollection->add($mapper->build());
        }

        return $userCollection;
    }
}
