<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(): Response
    {
        $carts=$this->getDoctrine()->getRepository(Cart::class)->findAll();
        return $this->render('panier/show.html.twig', [
            'controller_name' => 'CartController',
            'carts'=>$carts
        ]);
    }

    /**
     * @Route("/cart/add/{id}", name="add_cart")
     */
    public function add($id, ProduitRepository $repo): Response
    {
        $cart = new Cart();
        $produit = $repo->find($id);
        $cart->setUser($this->getUser());

        $cart->addProduit($produit);

        $cart->setPrix($cart->getPrix() + $produit->getPrix());

        $this->getDoctrine()->getManager()->persist($cart);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('produitfont');
    }
}
