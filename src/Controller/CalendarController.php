<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    /**
     * @Route("/calendar", name="calendar")
     */
    public function index(CategorieRepository $liste_events): Response
    {

        $events = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        $rdvs = [];




        foreach ($events as $event) {

            $rdvs [] = [
                'id' => $event->getId(),
                'date' => $event->getDateAjout()->format('Y-m-d'),
                'title' => $event->getNomCategorie(),

            ];
        }




        $data = json_encode($rdvs);
        return $this->render('calendrier/index.html.twig', compact('data'));
    }
}
