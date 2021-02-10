<?php
namespace App\Controller;

use App\Entity\Cb;
use App\Entity\Facture;
use App\Form\CbType;
use App\Form\FactureType;
use App\Repository\MembreRepository;
use App\Repository\CbRepository;
use App\Repository\ProduitRepository;
use App\Service\CartService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use \Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController {

    private $cartService;
    private $em;
    private $repoProduit;
    private $repoMembre;
    private $repoCb;

    public function __construct(
            CartService $cartService,
            ProduitRepository $repoProduit,
            MembreRepository $repoMembre,
            CbRepository $repoCb,
            EntityManagerInterface $em)

    {
        $this->cartService = $cartService;
        $this->em = $em;
        $this->repoProduit = $repoProduit;
        $this->repoMembre = $repoMembre;
        $this->repoCb = $repoCb;
    }

    /**
     * function qui affiche le panier
     * @Route("/panier", name="cart.index")
     * @return Response
     */
    public function index(){
        return $this->render('cart/index.html.twig', [
            'items' => $this->cartService->getFullCart(),
            'total'=> $this->cartService->getTotal(),
            'current_menu' => 'panier']
        );
    }

    /**
     * @Route("/panier/paiement", name="cart.paiement")
     * @param Facture $fac
     * @param Request $request
     * @return Response
     */
    public function paiement(Facture $fac, Request $request)
    {
        //$membre = $this->repoMembre->findOneBy(['id'=>2]);
        $cb= $this->repoCb->find(2);

        $formCb= $this->createForm(CbType::class, $cb);
        $formCb->handleRequest($request);

        if($formCb->isSubmitted() && $formCb->isValid()) {
            //dans l'idéal, les infos sur la carte bancaire sont transférées à la banque,
            //mais dans le cas de ce projet fictif, on saute cette étape

            //on commence par créer la facture
            $this->em->persist($fac);
            $this->em->flush();


            //on va donc enregistrer les lignes de commande
          /*
            $this->em->persist($cb);
            $this->em->flush();
            */
            $this->cartService->empty();
            $this->addFlash('success', 'Votre paiement a bien été pris en compte. La facture concernant votre commande vient de vous être envoyée par email.');
            return $this->render('cart/index.html.twig', ['current_menu' => 'panier']);
        }

        return $this->render('cart/paiement.html.twig', [
            'items' => $this->cartService->getFullCart(),
            'total'=> $this->cartService->getTotal(),
            'formCb' => $formCb->createView(),
            'sub_menu' => 'paiement',
            'current_menu' => 'panier']);
    }


        /**
     * @Route("/panier/validation", name="cart.validation")
     * @return Response
     */
    public function validation(Request $request){
        $fac= New Facture();
        $formFac= $this->createForm(FactureType::class, $fac);
        $formFac->handleRequest($request);

        if($formFac->isSubmitted() && $formFac->isValid()) {
            return $this->paiement($fac, $request);
        }

        return $this->render('cart/validation.html.twig', [
                'items' => $this->cartService->getFullCart(),
                'total'=> $this->cartService->getTotal(),
                'formFac' => $formFac->createView(),
                'sub_menu' => 'validation',
                'current_menu' => 'panier']
        );
    }

    /**
     * function qui ajoute UN produit $id du panier
     * @Route("/panier/add/{id}", name="cart.add")
     * @param $id
     * @param CartService $cartService
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function add(int $id){
        $this->cartService->add($id);
        return $this->redirectToRoute("cart.index", ['current_menu' => 'panier']);
    }

    /**
     * function qui supprime UN produit $id du panier
     * @Route("/panier/remove/{id}", name="cart.remove")
     * @param $id
     * @return RedirectResponse
     */
    public function remove(int $id): RedirectResponse{
        $this->cartService->remove($id);
        return $this->redirectToRoute("cart.index", ['current_menu' => 'panier']);
    }

    /**
     * function qui supprime TOUS les produits $id du panier
     * @Route("/panier/removeAll/{id}", name="cart.removeAll")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeAll(int $id): RedirectResponse{
        $this->cartService->removeAll($id);
        return $this->redirectToRoute("cart.index", ['current_menu' => 'panier']);
    }

    /**
     * //function qui vide tout le panier
     * @Route("/panier/empty", name="cart.empty")
     * @return RedirectResponse
     */
    public function empty(): RedirectResponse{
        $this->cartService->empty();
        return $this->redirectToRoute("cart.index", ['current_menu' => 'panier']);
    }
}