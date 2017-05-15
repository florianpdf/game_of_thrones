<?php

namespace GameOfThronesBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use GameOfThronesBundle\Entity\Royaume;

class LoadRoyaumeData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $royaumes = array(
            "nom" => "royaume_",
            "capitale" => "capitale_"
        );

        for ($i=1; $i <= 15; $i++){
            $r = new Royaume();
            $r->setNom($royaumes['nom'] . $i);
            $r->setCapitale($royaumes['capitale'] . $i);
            $r->setNbhabitants($i);
            $manager->persist($r);

            $this->addReference('royaume_' . $i, $r);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}