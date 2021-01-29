<?php
namespace App\Controller;
use App\Entity\Pointretrait;
use App\Repository\PointretraitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use \Symfony\Component\HttpFoundation\Response;
use \Symfony\Component\Routing\Annotation\Route;


class PointretraitController extends AbstractController
{

    /**
     * @var PointretraitRepository
     */
    private $repository;

    /**
     * @param PointretraitRepository
     * @param EntityManagerInterface
     */
    private $em;

    public function __construct(PointRetraitRepository $repository, EntityManagerInterface $em){
        $this->repository = $repository;
        $this->em = $em;
    }


    /**
     * @Route("/pointretrait", name="pointretrait.index")
     * @return Response
     */
    public function index(): Response
    {
        $allPR= $this->repository->findAllOrdered("nom");
        return $this->render('pointretrait/index.html.twig', ['current_menu' => 'pointretrait', 'allPR'=>$allPR]);
    }


    /**
     * @Route("/pointretrait/{slug}-{id}", name = "pointretrait.show", requirements = {"slug": "[a-z0-9\-]*"})
     * @param Pointretrait $pr
     * @param string $slug
     * @return Response
     */
    public function show(Pointretrait $pr, string $slug): Response
    {
        if($pr->getSlug() !== $slug) {
            return $this->redirectToRoute('pointretrait.show', [
                'id' => $pr->getId(),
                'slug'=> $pr->getSlug()
            ], 301);
        }
        return $this->render('pointretrait/show.html.twig', [
            'pointretrait' => $pr,
            'current_menu' => 'pointretrait'
        ]);
    }

}