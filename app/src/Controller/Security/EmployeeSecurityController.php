<?php

namespace App\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EmployeeSecurityController extends AbstractController
{
    #[Route('/security/employee/security', name: 'app_security_employee_security')]
    public function index(): Response
    {
        return $this->render('security/employee_security/index.html.twig', [
            'controller_name' => 'EmployeeSecurityController',
        ]);
    }
}
