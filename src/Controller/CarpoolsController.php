<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CarpoolsController extends AbstractController
{
    #[Route('/covoiturages', name: 'app_carpools')]
    public function index(Request $request): Response
    {
        /**
         * Récupération des paramètres GET envoyés par la search-bar.
         * Exemple d’URL :
         * /covoiturages?from=Caen&to=Paris&date=2025-02-11
         */
        $from = $request->query->get('from');   // Ville de départ
        $to = $request->query->get('to');       // Ville d’arrivée
        $date = $request->query->get('date');   // Date de départ

        /**
         * Plus tard : ici tu pourras faire une vraie recherche en BDD
         * via ton repository, si tu veux filtrer les covoiturages réels.
         *
         * Exemple futur :
         * $rides = $rideRepository->findBySearch($from, $to, $date);
         *
         * Pour l'instant tu envoies juste les valeurs à la vue.
         */

        return $this->render('carpools/index.html.twig', [
            'controller_name' => 'Page covoiturages',

            // 🔥 Ces valeurs seront réinjectées dans la search-bar (value="")
            'from' => $from,
            'to' => $to,
            'date' => $date,
        ]);
    }
}
