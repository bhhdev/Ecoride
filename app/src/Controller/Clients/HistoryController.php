<?php

namespace App\Controller\Clients;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HistoryController extends AbstractController
{
    #[Route('/historique', name: 'app_history')]
    public function index(): Response
    {
        return $this->render('history/index.html.twig', [
            'controller_name' => 'Page historique des covoiturages',
        ]);
    }
}
