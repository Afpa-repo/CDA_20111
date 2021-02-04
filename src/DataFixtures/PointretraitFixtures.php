<?php


namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Pointretrait;

class PointretraitFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        for($i=0;$i<10;$i++):
            $pointretrait = new Pointretrait();
            $pointretrait->setNom("Nom_point_retrait_".$i)
                ->setAdresse1("ChampAdresse1_point_retrait_".$i)
                ->setAdresse2("ChampAdresse2_point_retrait_".$i)
                ->setVille("Ville_point_retrait_".$i)
                ->setCp(strval(rand(80000,80999)))
                ->setEmail("point_retrait_".$i."@gmail.com")
                ->setPhoto("pointretrait".$i.".jpg")
                ->setOuverture(rand(0,10))
                ->setFermeture(rand(12,20))
                ->setJour(rand(0,6))
                ->setDescr("At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.");
            $manager->persist($pointretrait);
        endfor;
        $manager->flush();
    }
}
