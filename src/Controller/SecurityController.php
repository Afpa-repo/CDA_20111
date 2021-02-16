<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @Route("/inscription",name="security_registration")
     */

    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $membre = new Membre();

//  ----------------------appel du formulaire RegistrationType-----------------------------------------
        $form = $this->createForm(RegistrationType::class, $membre);

        $form->handleRequest($request);
//  --------------------traitement du formulaire s'il est soumis et valide-----------------------------------------
        if ($form->isSubmitted() && $form->isValid()) {
//encodage du mdp, UserPasswordEncoderInterface sert au hash du mdp et utilise l'encoder configuré dans security.yaml
            $hash = $encoder->encodePassword($membre, $membre->getMdp());
            $membre->setMDP($hash);
            $membre->setNiveau("1");
//            $manager envoie les données du formulaire vers la bdd
            $manager->persist($membre);
            $manager->flush();

//            retour sur la page de connexion
            return $this->redirectToRoute('home');
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/connexion",name="security_login")
     */
//    metode permettant la connexion, voir security.yaml pour configuration du provider et du firewall qui s'attachent à cette métode
    public function login()
    {
        return $this->render('security/login.html.twig');
    }

    /**
     * @Route("/deconnexion",name="security_logout")
     */
//metode servant à la deconnexion, voir security.yaml pour configuration de la deconnexion
    public function logout()
    {

    }
}
