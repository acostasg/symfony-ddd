<?php

namespace App\User\Presentation\Controller;

use App\User\Domain\Command\GetAllClientsCommand;
use App\User\Domain\Command\GetAllUsersCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    private GetAllUsersCommand $getAllUsersCommand;

    private GetAllClientsCommand $getAllClientsCommand;

    public function __construct(
        GetAllUsersCommand $getAllUsersCommand,
        GetAllClientsCommand $getAllClientsCommand
    ) {
        $this->getAllUsersCommand = $getAllUsersCommand;
        $this->getAllClientsCommand = $getAllClientsCommand;
    }

    public function index(): Response
    {
        return $this->render('@User/index.html.twig', [
            'title' => 'Default User Page',
            'type' => 'User',
            'text' => 'Test Description',
            'users' => $this->getAllUsersCommand->execute(),
            'clients' => $this->getAllClientsCommand->execute(),
        ]);
    }
}
