<?php

namespace App\Controller\Clients;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CarpoolsController extends AbstractController
{
    #[Route('/covoiturages', name: 'app_clients_carpools', methods: ['GET'])]
    public function index(): Response
    {
        // Le JS gère tout le mock / filtrage côté client.
        // Ici on renvoie simplement la page.
        return $this->render('clients/carpools/index.html.twig');
    }
}

