<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitfontController extends AbstractController
{
    /**
     * @Route("/produitfont", name="produitfont")
     */
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('produitfont/index.html.twig', [
            'prods' => $produitRepository->findAll(),
        ]);
    }
}
