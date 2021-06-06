<?php

namespace App\User\Presentation\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('../Twig/index.html.twig', [
            'title' => 'Default User Page',
            'type' => 'User',
            'text' => 'Test Description',
        ]);
    }
}
