<?php

namespace App\Controller\AStaff\Admin\SecurityAdmin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AdminSecurityController extends AbstractController
{
    #[Route('/a/staff/admin/security/admin/admin/security', name: 'app_a_staff_admin_security_admin_admin_security')]
    public function index(): Response
    {
        return $this->render('a_staff/admin/security_admin/admin_security/index.html.twig', [
            'controller_name' => 'AdminSecurityController',
        ]);
    }
}
