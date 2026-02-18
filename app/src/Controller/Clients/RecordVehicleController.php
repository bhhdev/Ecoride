<?php

namespace App\Controller\Clients;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/clients/record-vehicle')]
class RecordVehicleController extends AbstractController
{
    public function __construct() {

    }

    #[Route('/', name: 'app_clients_record_vehicle')] 
    public function index(): Response {
        
        return $this->render('clients/record_vehicle/index.html.twig', 
            [ 'controller_name' => 'RecordVehicleController', 
        ]);
    }
}