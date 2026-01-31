<?php

namespace App\Controller\AStaff\Admin\SecurityAdmin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class AdminLoginController extends AbstractController
{
    #[Route('/a/staff/admin/security/admin/admin/login', name: 'app_a_staff_admin_security_admin_admin_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('a_staff/admin/security_admin/admin_login/index.html.twig', [
            'controller_name' => 'AdminLoginController',
            'error' => $error,
            'last_username' => $lastUsername,
        ]);
    }
}
