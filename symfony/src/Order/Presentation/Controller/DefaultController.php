<?php

namespace App\Order\Presentation\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('@Order/index.html.twig', [
            'title' => 'Default Order Page',
            'type' => 'Order',
            'text' => 'Test Description',
        ]);
    }
}
