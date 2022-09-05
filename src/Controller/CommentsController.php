<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Comments;
use App\Form\CommentsType;

class CommentsController extends AbstractController
{
    /**
     * @Route("/comments", name="comments")
     */
    public function index(): Response
    {
        $data = $this->getDoctrine()->getRepository(Comments::class)->findAll();
        return $this->render('comments/index.html.twig', [
            'list' => $data
        ]);
    }
    /**
     * @Route("/addcomment", name="addcomment")
     */
    public function Comment(Request $request)
    {
       

       $comment = new Comments ();
       $form = $this->createForm(CommentsType::class,$comment);
       $form->handleRequest($request);
       
       if ($form->isSubmitted() && $form->isValid()) { 
           $em=$this->getDoctrine()->getManager();
           $em->persist($comment);
           $em->flush();
           $this->addFlash(
              'success',
              'Submitted'
           );
           return $this->redirectToRoute('comments');

       }
       return $this->render('comments/addcomment.html.twig',['form' => $form->createView()]);
    }
    /**
     * @Route("/updatecomment/{id}", name="updatecomment")
     */
    public function updatecomment(Request $request,$id)
    {
       

       $comment = $this->getDoctrine()->getRepository(Comments::class)->find($id);
       $form = $this->createForm(CommentsType::class,$comment);
       $form->handleRequest($request);
       
       if ($form->isSubmitted() && $form->isValid()) { 
           $em=$this->getDoctrine()->getManager();
           $em->persist($comment);
           $em->flush();
           $this->addFlash(
              'success',
              'Updated'
           );
           return $this->redirectToRoute('comments');
       }
       return $this->render('comments/updatecomment.html.twig',['form' => $form->createView()]);
    }
    /**
     * @Route("/deletecomment/{id}", name="deletecomment")
     */
    public function deletecomment($id)
    {
       

       $comments = $this->getDoctrine()->getRepository(Comments::class)->find($id);
       
       
      
           $em=$this->getDoctrine()->getManager();
           $em->remove($comments);
           $em->flush();
           $this->addFlash(
              'success',
              'deleted'
           );
           return $this->redirectToRoute('comments');
       
    }
}
