<?php

namespace App\DataFixtures;

use App\Entity\Fournisseur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FournisseurFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=0;$i<10;$i++):
            $fournisseur = new Fournisseur();
            $fournisseur->setNom("Nom_fournisseur_".$i)
                ->setAdresse1("ChampAdresse1_fournisseur_".$i)
                ->setAdresse2("ChampAdresse2_fournisseur_".$i)
                ->setVille("Ville_fournisseur n°".$i)
                ->setCp(strval(rand(80000,80999)))
                ->setTel("0".strval(rand(322000000,322999999)))
                ->setEmail("fournisseur_".$i."@gmail.com")
                ->setPhoto("photo_fournisseur_".$i.".jpg")
                ->setDescr("At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.");
            $manager->persist($fournisseur);
        endfor;
        $manager->flush();
    }
}
