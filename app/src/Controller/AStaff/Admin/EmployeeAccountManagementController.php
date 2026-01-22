<?php

namespace App\Controller\AStaff\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EmployeeAccountManagementController extends AbstractController
{
    #[Route('/a/staff/admin/employee/account/management', name: 'app_a_staff_admin_employee_account_management')]
    public function index(): Response
    {
        return $this->render('a_staff/admin/employee_account_management/index.html.twig', [
            'controller_name' => 'EmployeeAccountManagementController',
        ]);
    }
}
