<?php

namespace App\User\Infrastructure\Repository\InMemory;

use App\User\Domain\Model\Client;
use App\User\Domain\Model\Collection\ClientCollection;
use App\User\Domain\Model\Factory\ClientFactory;
use App\User\Domain\Repository\ClientRepositoryInterface;
use App\User\Domain\Repository\Exception\EntityNotFoundException;
use App\User\Domain\ValueObject\UserId;

class InMemoryClientRepository implements ClientRepositoryInterface
{
    private ClientCollection $clients;

    /**
     * InMemoryClientRepository constructor.
     */
    public function __construct()
    {
        $this->clients = new ClientCollection();
        $this->clients->add(
            ClientFactory::build(
                new UserId('8CE05088-ED1F-43E9-A415-3B3792655A9B'),
                'John',
                'Doe',
                'john@gmail.com'
            )
        );

        $this->clients->add(
            ClientFactory::build(
                new UserId('62A0CEB4-0403-4AA6-A6CD-1EE808AD4D23'),
                'Jean',
                'Bon',
                'jean@gmail.com'
            )
        );
    }

    /**
     * @throws EntityNotFoundException
     */
    public function client(UserId $userId): Client
    {
        foreach ($this->clients as $client) {
            if ($client->getId()->getValue() == $userId->getValue()) {
                return $client;
            }
        }
        throw new EntityNotFoundException();
    }

    public function all(): ClientCollection
    {
        return $this->clients;
    }

    public function add(Client $client): void
    {
        $this->clients->add($client);
    }

    public function remove(Client $client): void
    {
        $this->clients->remove($client);
    }
}
