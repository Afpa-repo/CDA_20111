<?php

namespace App\DataFixtures;

use App\Entity\Commercial;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CommercialFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=0;$i<10;$i++):
            $commercial = new Commercial();
            $commercial->setNom("Nom_Commercial_".$i)
                ->setPrenom("Prenom_Commercial_".$i)
                ->setTel("0".strval(rand(600000000,699999999)))
                ->setEmail("commercial_".$i."@gmail.com")
                ->setMdp(strval(rand(0,100000)));
            $manager->persist($commercial);
        endfor;
        $manager->flush();
    }
}
