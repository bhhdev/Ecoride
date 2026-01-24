<?php

namespace App\Controller\AStaff\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AdminDashboardController extends AbstractController
{
    #[Route('/a/staff/admin/admin/dashboard', name: 'app_a_staff_admin_admin_dashboard')]
    public function index(): Response
    {
        return $this->render('a_staff/admin/admin_dashboard/index.html.twig', [
            'controller_name' => 'AdminDashboardController',
        ]);
    }
}
