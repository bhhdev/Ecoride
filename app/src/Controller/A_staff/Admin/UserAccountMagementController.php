<?php

namespace App\Controller\A_staff\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class UserAccountManagementController extends AbstractController
{
    #[Route('/admin/users', name: 'app_admin_user_management')]
    public function index(): Response
    {
        return $this->render('A_staff/admin/user_account_management_admin/index.html.twig');
    }
}
