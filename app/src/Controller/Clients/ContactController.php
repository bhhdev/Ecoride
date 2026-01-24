<?php

namespace App\Controller\Clients;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_clients_contact')]
    public function index(): Response
    {
        return $this->render('clients/contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
}
