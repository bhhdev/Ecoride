<?php

namespace App\Controller\AStaff\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserAccountManagementController extends AbstractController
{
    #[Route('/a/staff/admin/user/account/management', name: 'app_a_staff_admin_user_account_management')]
    public function index(): Response
    {
        return $this->render('a_staff/admin/user_account_management/index.html.twig', [
            'controller_name' => 'UserAccountManagementController',
        ]);
    }
}
