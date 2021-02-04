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


    /**
     * PointretraitController constructor.
     * @param PointretraitRepository $repository
     * @param EntityManagerInterface $em
     */
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
        //on récupére tous les pointretrait dans la BDD et on les affiche sur pointretrait.index
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
        //si le slug reçu ($slug) ne correspond pas au slug du PointRetrait en question ($pr),
        //on redirige vers le pointretrait.show avec les paramètres corrects ($pr->getId(),$pr->getSlug())
        if($pr->getSlug() !== $slug) {
            return $this->redirectToRoute('pointretrait.show', [
                'id' => $pr->getId(),
                'slug'=> $pr->getSlug()
            ], 301);
        }
        //on redirige vers la page pointretrait/show
        return $this->render('pointretrait/show.html.twig', [
            'pointretrait' => $pr,
            'current_menu' => 'pointretrait'
        ]);
    }

}