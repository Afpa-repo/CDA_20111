<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Form\RecetteType;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;


class RecetteController extends AbstractController
{

    /**
     * @var RecetteRepository
     */
    private $repository;

    /**
     * @param ProduitRepository
     * @param EntityManagerInterface
     */
    private $em;

    public function __construct(RecetteRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/recette", name="recette")
     */
    public function index(): Response
    {
        $recette = $this->repository->findAll();
        return $this->render('recette/index.html.twig', [
            'controller_name' => 'RecetteController',
            'recette'=>$recette
        ]);
    }

    /**
     * @Route("/recette/new", name="recette_create")
     * @Route("/recette/{id}/edit", name="recette_edit")
     */
    public function form(Recette $recette = null , Request $request, EntityManagerInterface $entityManager){
        if(!$recette) {
            $recette = new Recette();
            // On récupère le membre connecté pour le lier à la publication, il apparaîtra dans le 'show'
            $recette->setAuteur($this->getUser());
        }
        //création du formulaire : commande php bin/console make:form puis on l'appelle

        $form= $this->createForm(RecetteType::class, $recette);


//On bind les données entrées dans le formulaire avec les attributs de l'entité
        $form->handleRequest($request);

//Validation et enregistrement dans la bdd
        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($recette);
            $entityManager->flush();

            return $this->redirectToRoute('show_recette', ['id' => $recette->getId()]);
        }
//On passe le formulaire à Twig
        return $this->render('recette/create.html.twig',
            [
                'formRecette' => $form->createView(),
                'editMode' => $recette->getId()!== null
            ]);
    }


    /**
     * @Route("/recette/{id}", name="show_recette")
     */
    public function show(Recette $recette){

        return $this->render('recette/show.html.twig',[
            'recette'=> $recette,
        ]);

    }
}