<?php

namespace App\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AdminSecurityController extends AbstractController
{
    #[Route('/security/admin/security', name: 'app_security_admin_security')]
    public function index(): Response
    {
        return $this->render('security/admin_security/index.html.twig', [
            'controller_name' => 'AdminSecurityController',
        ]);
    }
}
