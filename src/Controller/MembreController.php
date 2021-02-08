<?php

namespace App\Controller;

use App\Entity\Membre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use \Symfony\Component\Routing\Annotation\Route;

class MembreController extends AbstractController
{

//    /**
//     * @param Request $request
//     * @param ObjectManager $manager
//     * @Route("/subscribe",name="subscribe")
//     */
//
//    public function subscribe(Request $request)
//    {
//        $membre = new Membre();
//        $form = $this->createFormBuilder($membre)
//            ->add('civilite')
//            ->add('prenom')
//            ->add('nom')
//            ->add('ville')
//            ->add('email',EmailType::class)
//            ->add('mdp',PasswordType::class)->getForm();
//
//        return $this->render('authentification/subscribe.html.twig',[
//            'formSub'=>$form->createView()
//        ]);
//    }

}