<?php

namespace App\Controller\AStaff\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/a/staff/admin/home', name: 'app_a_staff_admin_home')]
    public function index(): Response
    {
        return $this->render('a_staff/admin/home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
