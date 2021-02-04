<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use App\Service\CartService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use \Symfony\Component\HttpFoundation\Response;
use \Symfony\Component\Routing\Annotation\Route;


class ProduitController extends AbstractController
{

    /**
     * @var ProduitRepository
     */
    private $repository;

    /**
     * @param ProduitRepository
     * @param EntityManagerInterface
     */
    private $em;

    public function __construct(ProduitRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }


    /**
     * @Route("/produit", name="produit.index")
     * @return Response
     */
    public function index(CartService $cartService): Response
    {
        //on retourne la liste des produits ainsi que le panier
        return $this->render('produit/index.html.twig', [
                'current_menu' => 'produit',
                'produits' => $this->repository->findAllOrdered("nom"),
                'panier' => $cartService->getCart()]
        );
    }

    /**
     * @Route("/produit/add/{id}", name="produit.add")
     * @param $id
     * @param CartService $cartService
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function add($id, CartService $cartService){
        //on ajoute un produit dans le panier
        $cartService->add($id);
        //on retourne la liste des produits ainsi que le panier mis à jour
        return $this->redirectToRoute("produit.index", [
            'current_menu' => 'panier',
            'panier'=> $cartService->getCart()
        ]);
    }

    /**
     * @Route("/produit/remove/{id}", name="produit.remove")
     * @param $id
     * @param CartService $cartService
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function remove($id, CartService $cartService){
        //on supprime un produit du le panier
        $cartService->remove($id);
        //on retourne la liste des produits ainsi que le panier mis à jour
        return $this->redirectToRoute("produit.index", [
            'current_menu' => 'panier',
            'panier'=> $cartService->getCart()
        ]);
    }

    /**
     * @Route("/produit/{slug}-{id}", name = "produit.show", requirements = {"slug": "[a-z0-9\-]*"})
     * @param Produit $produit
     * @param string $slug
     * @return Response
     */
    public function show(Produit $produit, string $slug): Response
    {
        //si le slug reçu ($slug) ne correspond pas au slug du Produit en question ($produit),
        //on redirige vers le produit.show avec les paramètres corrects ($produit->getId(),$produit->getSlug())
        if ($produit->getSlug() !== $slug) {
            return $this->redirectToRoute('produit.show', [
                'id' => $produit->getId(),
                'slug' => $produit->getSlug()
            ], 301);
        }

        //on redirige vers la page produit/show.html.twig
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
            'current_menu' => 'produit'
        ]);
    }

}