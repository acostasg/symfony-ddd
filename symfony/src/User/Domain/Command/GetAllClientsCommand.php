<?php

namespace App\User\Domain\Command;

use App\User\Domain\Model\Collection\ClientCollection;
use App\User\Domain\Repository\ClientRepositoryInterface;

class GetAllClientsCommand
{
    private ClientRepositoryInterface $clientRepository;

    /**
     * GetAllUsersCommand constructor.
     */
    public function __construct(ClientRepositoryInterface $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function execute(): ClientCollection
    {
        return $this->clientRepository->all();
    }
}
