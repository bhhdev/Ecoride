<?php

namespace App\Controller\AStaff\Employee\SecurityEmployee;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EmployeeSecurityController extends AbstractController
{
    #[Route('/a/staff/employee/security/employee/employee/security', name: 'app_a_staff_employee_security_employee_employee_security')]
    public function index(): Response
    {
        return $this->render('a_staff/employee/security_employee/employee_security/index.html.twig', [
            'controller_name' => 'EmployeeSecurityController',
        ]);
    }
}
