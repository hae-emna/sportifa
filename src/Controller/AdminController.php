<?php

namespace App\Controller;


use App\Entity\User;
use App\Repository\UserRepository;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/role", name="affect_role")
     */
    public function affect_role(UserRepository $repo, Request $request, LoggerInterface $log): Response
    {
        $form = $this->createFormBuilder();

        $form->add('Users', EntityType::class, [
            'class' => User::class,
            'choice_label' => 'email'
        ]);

        $form->add('Roles', ChoiceType::class, [
            'choices' => [
                'User' => 'ROLE_USER',
                'Admin' => 'ROLE_ADMIN',
                'Coach' => 'ROLE_COACH'
            ]
        ]);

        $form = $form->getForm();

        if($form->handleRequest($request)){
            if($form->isSubmitted() && $form->isValid()){
                $data = $form->getData();
                $data["Users"]->setRoles([$data["Roles"]]);
                $this->getDoctrine()->getManager()->persist($data['Users']);
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('dashboard');
            }
        }

        return $this->render('admin/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
