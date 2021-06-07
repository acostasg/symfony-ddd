<?php

namespace App\User\Infrastructure\Repository\Doctrine;

use App\User\Domain\Model\Client;
use App\User\Domain\Model\Collection\ClientCollection;
use App\User\Domain\Repository\ClientRepositoryInterface;
use App\User\Domain\Repository\Exception\ErrorPersistEntityException;
use App\User\Domain\Repository\Exception\ErrorRemoveEntityException;
use App\User\Domain\ValueObject\UserId;
use App\User\Infrastructure\Repository\Doctrine\Mapping\ClientMapper;
use Doctrine\ORM\EntityRepository as EntityRepository;

class ClientRepository extends EntityRepository implements ClientRepositoryInterface
{
    /**
     * @throws ErrorPersistEntityException
     */
    public function add(Client $client): void
    {
        try {
            $this->getEntityManager()->persist(
                new ClientMapper($client)
            );
            $this->getEntityManager()->flush();
        } catch (\Exception $e) {
            throw new ErrorPersistEntityException($e->getMessage());
        }
    }

    /**
     * @throws ErrorRemoveEntityException
     */
    public function remove(Client $client): void
    {
        try {
            $this->getEntityManager()->remove(
                new ClientMapper($client)
            );
            $this->getEntityManager()->flush();
        } catch (\Exception $e) {
            throw new ErrorRemoveEntityException($e->getMessage());
        }
    }

    public function client(UserId $userId): Client
    {
        $mapper = $this->find($userId->getValue());

        return $mapper->build();
    }

    public function all(): ClientCollection
    {
        $array = $this->findBy([], ['firstName' => 'ASC']);

        $clientCollection = new ClientCollection();
        foreach ($array as $mapper) {
            $clientCollection->add($mapper->build());
        }

        return $clientCollection;
    }
}
