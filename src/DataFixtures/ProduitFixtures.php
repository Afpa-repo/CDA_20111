<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProduitFixtures extends Fixture
{
    private $nbUniteMesure = [1,2,3,4,5,50,100,150,200,500,750];
    private $uniteMesure = ['mg','g','kg','mL','L','pièce(s)'];

    public function load(ObjectManager $manager)
    {

        for($i=0;$i<10;$i++):
            $produit = new Produit();
            $produit->setNom("Nom du Produit n°".$i)
                ->setRef("Ref_".$i)
                ->setStock(rand(1,100))
                ->setPrix(rand(0.50,30.00))
                ->setUniteMesure($this->uniteMesure[(array_rand($this->uniteMesure))])
                ->setNbUniteMesure($this->nbUniteMesure[(array_rand($this->nbUniteMesure))])
                ->setSaison(rand(1,4))
                ->setDescr("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.")
                ->setPhoto("produit".$i.".jpg");
            $manager->persist($produit);
        endfor;
        $manager->flush();

    }
}
