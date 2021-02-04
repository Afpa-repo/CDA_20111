<?php
namespace App\Controller;

use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use \Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController {

    /**
     * function qui affiche le panier
     * @Route("/panier", name="cart.index")
     * @param CartService $cartService
     * @return Response
     */
    public function index(CartService $cartService){
        return $this->render('cart/index.html.twig', [
            'items' => $cartService->getFullCart(),
            'total'=> $cartService->getTotal(),
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
    public function add($id, CartService $cartService){
        $cartService->add($id);
        return $this->redirectToRoute("cart.index", ['current_menu' => 'panier']);
    }

    /**
     * function qui supprime UN produit $id du panier
     * @Route("/panier/remove/{id}", name="cart.remove")
     * @param $id
     * @param CartService $cartService
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function remove($id, CartService $cartService): RedirectResponse{
        $cartService->remove($id);
        return $this->redirectToRoute("cart.index", ['current_menu' => 'panier']);
    }

    /**
     * function qui supprime TOUS les produits $id du panier
     * @Route("/panier/removeAll/{id}", name="cart.removeAll")
     * @param CartService $cartService
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeAll(CartService $cartService): RedirectResponse{
        $cartService->removeAll($id);
        return $this->redirectToRoute("cart.index", ['current_menu' => 'panier']);
    }

    /**
     * //function qui vide tout le panier
     * @Route("/panier/empty", name="cart.empty")
     * @param CartService $cartService
     * @return RedirectResponse
     */
    public function empty(CartService $cartService): RedirectResponse{
        $cartService->empty();
        return $this->redirectToRoute("cart.index", ['current_menu' => 'panier']);
    }
}