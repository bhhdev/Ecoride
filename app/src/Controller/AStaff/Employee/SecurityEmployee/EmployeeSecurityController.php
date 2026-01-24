<?php

namespace App\Controller\AStaff\Employee\SecurityEmployee;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EmployeeSecurityController extends AbstractController
{
    #[Route('/dev/employee/login', name: 'dev_employee_login')]
    public function index(): Response
    {
        return $this->render('a_staff/employee/security_employee/index.html.twig', [
            'controller_name' => 'EmployeeSecurityController',
        ]);
    }
}

