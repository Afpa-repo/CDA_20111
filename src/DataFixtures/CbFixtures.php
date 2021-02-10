<?php

namespace App\DataFixtures;

use App\Repository\MembreRepository;
use App\Entity\Cb;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CbFixtures extends Fixture implements DependentFixtureInterface
{
    private $membreRepo;

    public function __construct(MembreRepository $membreRepo){
        $this->membreRepo = $membreRepo;
    }

    public function load(ObjectManager $manager)
    {
        for($i=0;$i<10;$i++):
            $cb = new Cb();
            $cb->setNom("NomMembre".$i)
                ->setPrenom("PrenomMembre".$i)
                ->setNumero(password_hash('1111222233334444', PASSWORD_BCRYPT, ['cost'=>12]))
                ->setLastDigits("4444")
                ->setDate(["03","22"])
                ->setMembre($this->getReference("membre".$i));
            $manager->persist($cb);
        endfor;
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            MembreFixtures::class,
        );
    }




}