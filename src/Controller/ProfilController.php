<?php


namespace App\Controller;

use App\Repository\MembreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\EditProfilType;
use App\Entity\Membre;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProfilController extends AbstractController
{
    /**
     * @var MembreRepository
     */
    private $repository;

    /**
     * @param MembreRepository
     * @param EntityManagerInterface
     */
    private $em;

    public function __construct(MembreRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }
    /**
     * @Route("/profil", name="profil")
     * @return Response
     */
    public function index():Response
    {
        return $this->render('profil/view.html.twig');
    }

    /**
     * @Route("/profil/{id}/recettes", name="profil_recettes")
     * @return Response
     */
    public function showRecettes():Response {
        return $this->render('profil/recettes.html.twig');
    }
    /**
     * @Route("/profil/{id}/commandes", name="profil_commandes")
     * @return Response
     */
    public function showCommandes():Response {
        return $this->render('profil/commandes.html.twig');
    }

    /**
     * @Route("/profil/{id}/edit", name="profil_edit")
     * @param Request $request
     * @param ObjectManager $manager
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function edit(Request $request,EntityManagerInterface $manager){
        // On récupère l'utilisateur connecté
        $user = $this->getUser();
        // Création du formulaire avec validation des valeurs par défaut si inchangées
        $formEditProfil =$this->createForm(EditProfilType::class, $user,
            ['validation_groups' => ['Default']
            ]);

        //analyse de la requete passée
        $formEditProfil->handleRequest($request);
        //Vérification des données
        if ($formEditProfil->isSubmitted() && $formEditProfil->isValid()){

            $manager->persist($user);
            $manager->flush();

            return $this -> redirectToRoute('profil');
        }

        return $this-> render('profil/edit.html.twig',[
            'formProfil' => $formEditProfil->createView()
        ]);
    }

    /**
     * @Route("/profil/{id}/editpass", name="profil_edit_password")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return mixed
     */
    public function editPassword(Request $request, UserPasswordEncoderInterface $passwordEncoder) {
        if($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();

            // mots de passe identiques ?
            if($request->request->get('mdp') == $request->request->get('mdp2')){
                $user->setMdp($passwordEncoder->encodePassword($user, $request->request->get('mdp2')));
                $em->flush();
                $this->addFlash('message', 'Mot de passe mis à jour');
                return $this->redirectToRoute('profil');
            }else{
                $this->addFlash('error', 'Les deux mots de passe ne sont pas identiques.');
            }
        }
            return $this->render('profil/editPass.html.twig');
    }

}