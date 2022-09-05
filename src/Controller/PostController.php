<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Form\PostType;

class PostController extends AbstractController
{
    /**
     * @Route("/post", name="post")
     */
    public function index(): Response
    {
        $data = $this->getDoctrine()->getRepository(Post::class)->findAll();
        return $this->render('post/posts.html.twig', [
            'list' => $data
        ]);
    }
    /**
     * @Route("/addpost", name="addpost")
     */
    public function addpost(Request $request)
    {
       

       $post = new Post ();
       $form = $this->createForm(PostType::class,$post);
       $form->handleRequest($request);
       
       if ($form->isSubmitted() && $form->isValid()) { 
           $em=$this->getDoctrine()->getManager();
           $em->persist($post);
           $em->flush();
           $this->addFlash(
              'success',
              'Submitted'
           );
           return $this->redirectToRoute('post');

       }
       return $this->render('post/addpost.html.twig',['form' => $form->createView()]);
    }
    /**
     * @Route("/updatepost/{id}", name="updatepost")
     */
    public function updatepost(Request $request,$id)
    {
       

       $post = $this->getDoctrine()->getRepository(Post::class)->find($id);
       $form = $this->createForm(PostType::class,$post);
       $form->handleRequest($request);
       
       if ($form->isSubmitted() && $form->isValid()) { 
           $em=$this->getDoctrine()->getManager();
           $em->persist($post);
           $em->flush();
           $this->addFlash(
              'success',
              'Updated'
           );
           return $this->redirectToRoute('post');
       }
       return $this->render('post/updatepost.html.twig',['form' => $form->createView()]);
    }
    /**
     * @Route("/deletepost/{id}", name="deletepost")
     */
    public function deletepost($id)
    {
       

       $post = $this->getDoctrine()->getRepository(Post::class)->find($id);
       
       
      
           $em=$this->getDoctrine()->getManager();
           $em->remove($post);
           $em->flush();
           $this->addFlash(
              'success',
              'deleted'
           );
           return $this->redirectToRoute('post');
       
    }
}
