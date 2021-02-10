<?php

namespace App\DataFixtures;

use App\Entity\Membre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class MembreFixtures extends Fixture implements FixtureGroupInterface
{
   public function load(ObjectManager $manager)
    {
        for($i=0;$i<10;$i++):
           $ref = 'membre'.$i;
            $membre = new Membre();
            $membre->setCivilite("Mr")
                ->setNom("Nom_Membre_".$i)
                ->setPrenom("Prenom_Membre_".$i)
                ->setAdresse1("Adresse1_Membre_".$i)
                ->setAdresse2("Adresse2_Membre_".$i)
                ->setVille("Ville_Membre_".$i)
                ->setCp(strval(rand(80000,80999)))
                ->setTel("0".strval(rand(600000000,699999999)))
                ->setEmail("membre_".$i."@gmail.com")
                ->setBloque(0)
                ->setPseudo("pseudo_Membre_".$i)
                ->setPhoto("membre".$i.".jpg")
                ->setMdp(password_hash("Password".$i, PASSWORD_BCRYPT, ['cost'=>12]))
                ->setNiveau(1)
                ->setDescr("Salut les Foodies! Moi c'est Membre n°".$i);
            $this->addReference($ref, $membre);
            $manager->persist($membre);
        endfor;
        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['group1', 'group2'];
    }


}