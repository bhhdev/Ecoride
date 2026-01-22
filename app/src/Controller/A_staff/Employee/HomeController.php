<?php

namespace App\Controller\Staff\Employee;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HomeController extends AbstractController
{
    #[Route('/employee/home', name: 'app_employee_home')]
    public function index(): Response
    {
        return $this->render('1-staff/employee/Home_employee/index.html.twig');
    }
}
