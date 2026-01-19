<?php

namespace App\Controller\Security; // <-- Changement du namespace

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ClientSecurityController extends AbstractController // <-- Changement du nom de la classe
{
    #[Route(path: '/client/connexion', name: 'app_client_login')] // <-- Route spécifique au client
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/client_security/login.html.twig', [ // <-- Nouveau template
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/client/logout', name: 'app_client_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - intercepted by firewall.');
    }
}
