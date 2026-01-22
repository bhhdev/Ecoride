<?php

namespace App\Controller\A_staff\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class EmployeeAccountManagementController extends AbstractController
{
    #[Route('/admin/employees', name: 'app_admin_employee_management')]
    public function index(): Response
    {
        // Assure-toi que le template existe exactement ici :
        // templates/A_staff/admin/employee_account_management_admin/index.html.twig
        return $this->render('A_staff/admin/employee_account_management_admin/index.html.twig', [
            'controller_name' => 'Employee Account Management',
        ]);
    }
}
