<?php

namespace App\Controller\Clients;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CarpoolsController extends AbstractController
{
    #[Route('/carpools', name: 'app_clients_carpools')]
    public function index(): Response
    {
        return $this->render('clients/carpools/index.html.twig', [
            'controller_name' => 'Covoiturages',
        ]);
    }
}
