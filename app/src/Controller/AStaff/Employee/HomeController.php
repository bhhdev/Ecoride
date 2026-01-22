<?php

namespace App\Controller\AStaff\Employee;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/a/staff/employee/home', name: 'app_a_staff_employee_home')]
    public function index(): Response
    {
        return $this->render('a_staff/employee/home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
