<?php

namespace App\Controller\Staff\Employee\SecurityEmployee;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class EmployeeSecurityController extends AbstractController
{
    #[Route('/employee/login', name: 'app_employee_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('1-staff/employee/security_employee/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    #[Route('/employee/logout', name: 'app_employee_logout')]
    public function logout(): void
    {
        throw new \LogicException('Logout intercepted by firewall.');
    }
}
