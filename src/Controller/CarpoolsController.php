<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CarpoolsController extends AbstractController
{
    #[Route('/covoiturages', name: 'app_carpools')]
    public function index(): Response
    {
        return $this->render('carpools/index.html.twig', [
            'controller_name' => 'Page covoiturages',
        ]);
    }
}
