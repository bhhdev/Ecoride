<?php

namespace App\Controller\AStaff\Employee\Dashboard;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/a-staff/employee/dashboard', name: 'astaff_employee_dashboard_')]
class EmployeeDashboardController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('a_staff/employee/dashboard/employee_dashboard/index.html.twig', [
            'controller_name' => 'EmployeeDashboardController',
        ]);
    }
}
