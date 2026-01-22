<?php

namespace App\Controller\Clients;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FiltersMenuController extends AbstractController
{
    #[Route('/menu-filtres', name: 'app_filters_menu')]
    public function index(): Response
    {
        return $this->render('filters_menu/index.html.twig', [
            'controller_name' => 'FiltersMenuController',
        ]);
    }
}
