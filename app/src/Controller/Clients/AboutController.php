<?php

namespace App\Controller\Clients;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AboutController extends AbstractController
{
    #[Route('/a_propos', name: 'app_clients_about')]
    public function index(): Response
    {
        return $this->render('clients/about/index.html.twig', [
            'controller_name' => 'Page à propos',
        ]);
    }
}
