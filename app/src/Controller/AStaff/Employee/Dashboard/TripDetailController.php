<?php

namespace App\Controller\AStaff\Employee\Dashboard;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dev/trip-detail', name: 'dev_trip_detail_')]
class TripDetailController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('a_staff/employee/dashboard/trip_detail/index.html.twig', [
            'controller_name' => 'AStaff/Employee/Dashboard/TripDetailController',
        ]);
    }
}
