<?php

namespace App\Controller\Clients\SecurityClients;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class ClientsSecurityController extends AbstractController
{
    #[Route('/login', name: 'app_clients_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('clients/security_clients/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
        ]);
    }

    #[Route('/logout', name: 'app_clients_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method will be intercepted by the firewall.');
    }
}
