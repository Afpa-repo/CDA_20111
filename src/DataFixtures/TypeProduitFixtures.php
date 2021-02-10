<?php

namespace App\DataFixtures;

use App\Entity\TypeProduit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for($i=0;$i<10;$i++):
            $tp = new TypeProduit();
            $tp->setNom("Type n°".$i." de Produits")
                ->setDescr("Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.")
                ->setPhoto("default.jpg");
            $manager->persist($tp);
        endfor;
        $manager->flush();
    }
}
