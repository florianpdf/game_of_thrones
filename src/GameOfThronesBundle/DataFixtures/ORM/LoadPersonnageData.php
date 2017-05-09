<?php

namespace GameOfThronesBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use GameOfThronesBundle\Entity\Personnage;

class LoadPersonnageData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $personnages = array(
            array(
                "bio" => "formateur",
                "nom" => "grandjean",
                "prenom" => "florian",
                "sexe" => 'homme'
            ),
            array(
                "bio" => "livreur",
                "nom" => "einstein",
                "prenom" => "albert",
                "sexe" => 'homme'
            ),
            array(
                "bio" => "caissière",
                "nom" => "borin",
                "prenom" => "ginette",
                "sexe" => 'femme'
            ),
            array(
                "bio" => "patron",
                "nom" => "dur",
                "prenom" => "oeuf",
                "sexe" => 'homme'
            ),

        );

        foreach ($personnages as $perso){
            $p = new Personnage();
            $p->setSexe($perso['sexe']);
            $p->setBio($perso['bio']);
            $p->setNom(ucfirst($perso['nom']));
            $p->setPrenom(ucfirst($perso['prenom']));

            $p->setRoyaume($this->getReference('royaume_1'));

            $manager->persist($p);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}