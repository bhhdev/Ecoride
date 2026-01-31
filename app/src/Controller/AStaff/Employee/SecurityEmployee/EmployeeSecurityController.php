<?php

namespace App\Controller\AStaff\Employee\SecurityEmployee;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class EmployeeSecurityController extends AbstractController
{
    #[Route('/dev/employee/login', name: 'dev_employee_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('a_staff/employee/security_employee/index.html.twig', [
            'controller_name' => 'EmployeeSecurityController',
            'error' => $error,
            'last_username' => $lastUsername,
        ]);
    }
}
