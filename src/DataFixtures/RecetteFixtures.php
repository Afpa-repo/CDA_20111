<?php

namespace App\DataFixtures;
use App\Entity\Recette;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RecetteFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
            for ($i = 1; $i <= 10; $i++) {
                $recette = new Recette();
                $recette->setNom("Recette N°$i")
                    ->setDescr("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh. Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam sodales hendrerit.")
                    ->setPhoto("recette" . $i . ".jpg")
                    ->setRatingN(rand(1, 10))
                    ->setRatingP(rand(1, 10))
                    ->setTpsPrep(rand(10, 60))
                    ->setTpsCuisson(rand(10, 120))
                    ->setPortion(rand(2, 12))
                    ->setDifficulte(rand(1, 5));
                $manager->persist($recette);
            }
            $manager->flush();
        }
    }
//php bin/console doctrine:fixtures:load
