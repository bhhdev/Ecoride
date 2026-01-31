<?php

namespace App\Controller\AStaff\Employee\Dashboard;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/a-staff/employee/dashboard', name: 'astaff_employee_dashboard_')]
class EmployeeDashboardController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        $covoiturages = [
            [
                'id' => 1,
                'date' => new \DateTime('today'),
                'driver' => 'Jean Dupont',
                'note' => 5,
            ],
            [
                'id' => 2,
                'date' => new \DateTime('today'),
                'driver' => 'Marie Martin',
                'note' => 2,
            ],
            [
                'id' => 3,
                'date' => new \DateTime('today'),
                'driver' => 'Paul Bernard',
                'note' => 3,
            ],
        ];

        return $this->render(
            'a_staff/employee/dashboard/employee_dashboard/index.html.twig',
            [
                'covoiturages' => $covoiturages,
            ]
        );
    }
}
