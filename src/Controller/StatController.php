<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatController extends AbstractController
{
    /**
     * @Route("/stat", name="stat")
     */
    public function index(ProduitRepository $repo): Response
    {
        $prods = $repo->findAll();
        $sum = 0;
        foreach($prods as $prod){
            $sum+= $prod->getPrix() * $prod->getQuantite();
        }
        return $this->render('stat/index.html.twig', [
            'sum' => $sum,
            'nbr' => count($prods)
        ]);
    }
}
