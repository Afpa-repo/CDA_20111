<?php
namespace App\Controller\Admin;

use App\Form\PointRetraitType;
use App\Entity\PointRetrait;
use App\Repository\PointRetraitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPointRetraitController extends AbstractController{

    /**
     * @var PointRetraitRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(PointRetraitRepository $repository, EntityManagerInterface $em){
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin", name="admin.pointretrait.index")
     *
     */
    public function index(){
        $pointretrait = $this->repository->findAll();
        return $this->render('admin/pointretrait/index.html.twig', compact('pointretrait'));
    }

    /**
     * @Route("/admin/pointretrait/create", name="admin.pointretrait.new")
     */
    public function new(Request $request)
    {
        $pointretrait = new PointRetrait();

        $form = $this->createForm(PointRetraitType::class, $pointretrait);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($pointretrait);
            $this->em->flush();
            return $this->redirectToRoute('admin.pointretrait.index');
        }
        return $this->render('admin/pointretrait/new.html.twig', [
            'pointretrait'=> $pointretrait,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/admin/poinretrait/{id}", name="admin.pointretrait.edit", methods="GET|POST")
     * @param PointRetrait $pr
     * @param Request $request
     * @param PointRetrait $pointretrait
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(PointRetrait $pointretrait, Request $request)
    {
        $form = $this->createForm(PointRetraitType::class, $pointretrait);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Le Point Retrait a été mis à jour avec succès.');
            return $this->redirectToRoute('admin.pointretrait.index');
        }
        return $this->render('admin/pointretrait/edit.html.twig', [
            'pointretrait'=> $pointretrait,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/pointretrait/{id}", name="admin.pointretrait.delete", methods="DELETE")
     */
    public function delete(PointRetrait $pointretrait, Request $request)
    {
        //on vérifie que le Token du Form est valide afin de procéder à la suppression
        if($this->isCsrfTokenValid('delete'.$pointretrait->getId(), $request->get('_token'))){
            $this->em->remove($pointretrait);
            $this->addFlash('success', 'Le Point Retrait a été supprimé avec succès.');
            $this->em->flush();
        }
        return $this->redirectToRoute('admin.pointretrait.index');
    }
}