<?php


namespace App\Controller;

use App\Repository\MembreRepository;
use App\Repository\PaiementRepository;
use App\Service\CartService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use \Symfony\Component\Routing\Annotation\Route;

class PaiementController extends AbstractController
{

    /**
     * @var CartService
     */
    protected $cartService;
    /**
     * @var PaiementRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(PaiementRepository $repository, EntityManagerInterface $em,CartService $cartService){
        $this->cartService = $cartService;
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("paiement", name="paiement.index")
     * @return Response
     */
    public function index(){
        // 'membre' sera à modifier une fois que les pages d'authentification seront créées
        return $this->render('paiement/index.html.twig', [
                'panier' => $this->cartService->getFullCart(),
                'total'=> $this->cartService->getTotal(),
                'membre' => (new MembreRepository())->find(1),
                'current_menu' => 'panier'
                ]);
    }
}