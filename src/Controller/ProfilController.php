<?php


namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\EditProfilType;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     * @return Response
     */
    public function index():Response
    {
        return $this->render('profil/view.html.twig');
    }
    /**
     * @Route("/profil/{id}/edit", name="profil_edit")
     * @param Request $request
     * @param ObjectManager $manager
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function edit(Request $request,EntityManagerInterface $manager){

        $user = $this->getUser();

        $formEditProfil =$this->createForm(EditProfilType::class, $user,
            ['validation_groups' => ['Default']
            ]);

        //analyse de la requete passée
        $formEditProfil->handleRequest($request);

        if ($formEditProfil->isSubmitted() && $formEditProfil->isValid()){

            $manager->persist($user);
            $manager->flush();

            return $this -> redirectToRoute('profil');
        }
        //Vérification des données passées pour le User
        //dump($user);
        return $this-> render('profil/edit.html.twig',[
            'formProfil' => $formEditProfil->createView()
        ]);
    }
}