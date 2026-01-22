<?php

namespace App\Controller\Clients;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HistoryController extends AbstractController
{
    #[Route('/history', name: 'app_clients_history')]
    public function index(): Response
    {
        return $this->render('clients/history/index.html.twig', [
            'controller_name' => 'Historique',
        ]);
    }
}
