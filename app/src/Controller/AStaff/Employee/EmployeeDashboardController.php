<?php

namespace App\Controller\AStaff\Employee;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EmployeeDashboardController extends AbstractController
{
    #[Route('/a/staff/employee/employee/dashboard', name: 'app_a_staff_employee_employee_dashboard')]
    public function index(): Response
    {
        return $this->render('a_staff/employee/employee_dashboard/index.html.twig', [
            'controller_name' => 'EmployeeDashboardController',
        ]);
    }
}
