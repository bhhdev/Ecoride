<?php

namespace App\Controller\Clients\Security;

use App\Entity\Vehicle;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;

class ClientSecurityController extends AbstractController
{
    #[Route(path: '/clients/login', name: 'app_clients_security_login')]
    public function login(
        AuthenticationUtils $authenticationUtils,
        EntityManagerInterface $entityManager,
        Request $request,
    ): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('clients/security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/clients/logout', name: 'app_clients_security_logout')]
    public function logout(): void
    {
        throw new \LogicException('Intercepted by the firewall logout.');
    }
}