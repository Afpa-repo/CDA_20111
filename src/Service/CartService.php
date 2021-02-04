<?php
namespace App\Service;

use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class CartService{

    protected $session;
    protected $produitRepository;

    /**
     * CartService constructor.
     * @param SessionInterface $session
     * @param ProduitRepository $produitRepository
     */
    public function __construct(SessionInterface $session, ProduitRepository $produitRepository){
        $this->session = $session;
        $this->produitRepository = $produitRepository;
    }

    /**
     * function pour ajouter un produit dans le panier
     * @param int $id
     */
    public function add(int $id) : void{
        //la methode get va chercher la variable $panier dans l'objet $session. Si le panier n'existe pas, il va le créer en créant un tableau vide
        $panier = $this->session->get('panier', []);
        if(!empty($panier[$id])){
            $panier[$id]++;
        }else $panier[$id]= 1;
        $this->session->set('panier', $panier);
    }

    /**
     * function pour supprimer un produit du panier
     * @param int $id
     */
    public function removeAll(int $id) : void{
        //la methode get va chercher la variable $panier dans l'objet $session. Si le panier n'existe pas, il va le créer en créant un tableau vide
        $panier = $this->session->get('panier', []);
        if(!empty($panier[$id])){
            unset($panier[$id]);
        }
        $this->session->set('panier', $panier);
    }

    /**
     * function pour supprimer un produit du panier
     * @param int $id
     */
    public function remove(int $id) : void{
        //la methode get va chercher la variable $panier dans l'objet $session. Si le panier n'existe pas, il va le créer en créant un tableau vide
        $panier = $this->session->get('panier', []);
        //si le panier n'est pas vide et que le produit est bien présent dans le panier, on réduit sa quantité de 1
        if((!empty($panier[$id]))&&($panier[$id]!==0))
        {
            $panier[$id]--;
            //si la quantité du produit est à 0, on le supprime du panier
            if($panier[$id]===0) unset($panier[$id]);
        }
        $this->session->set('panier', $panier);
    }

    /**
     * function pour vider le panier
     */
    public function empty() : void{
        $this->session->clear('panier');
    }

    /**
     * fonction qui retourne le panier sous forme de table id => quantite
     * @return array
     */
    public function getCart() : array{
        return $this->session->get('panier', []);
    }


    /**
     * fonction qui retourne le panier sous forme de tableau,
     * avec la quantité des produits et le détail des produits (class Produit)
     * @return array
     */
    public function getFullCart() : array{
        //on récupère le panier
        $panier = $this->session->get('panier', []);
        $panierWithData = [];
        foreach($panier as $id => $quantity):
            //on affecte les détails du produit et sa quantité dans le tableau $panierWithData
            $panierWithData[] = [
                'produit' => $this->produitRepository->find($id),
                'quantite' => $quantity
            ];
        endforeach;
        //on retourne la panier avec le détail des produits
        return $panierWithData;
    }

    /**
     * fonction qui retourne le total du panier
     * @return float
     */
    public function getTotal() : float{
        $total = 0;
        foreach($this->getFullCart() as $item):
            //on incrémente $total avec la total pour chaque produit
            $total += $item['produit']->getPrix()*$item['quantite'];
        endforeach;
        return $total;
    }

}