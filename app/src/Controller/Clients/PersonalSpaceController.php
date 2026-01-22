<?php

namespace App\Controller\Clients;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class PersonalSpaceController extends AbstractController
{
    #[Route('/personal-space', name: 'app_clients_personal_space')]
    public function index(): Response
    {
        return $this->render('clients/personal_space/index.html.twig', [
            'controller_name' => 'Espace personnel',
        ]);
    }
}
