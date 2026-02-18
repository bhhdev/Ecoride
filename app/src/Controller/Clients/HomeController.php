<?php

namespace App\Controller\Clients;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/clients/', name: 'app_clients_home')]
    public function index(): Response
    {
        return $this->render('clients/home/index.html.twig');
    }
}
