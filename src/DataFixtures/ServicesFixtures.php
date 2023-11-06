<?php

namespace App\DataFixtures;

use App\Entity\Services;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ServicesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        // Service numéro 1

        $service1 = new Services();
        $service1->setServiceTitle('Révision simple')
            ->setPrice(150)
            ->setDescription('La révision automobile consiste à examiner les différents composants de votre voiture.');

        $manager->persist($service1);

          // Service numéro 2

        $service2 = new Services();
        $service2->setServiceTitle('Révision complète')
            ->setPrice(300)
            ->setDescription('La révision automobile consiste à examiner les différents composants de votre voiture.');

        $manager->persist($service2);

        // Service numéro 3

        $service3 = new Services();
        $service3->setServiceTitle('Changement des plaquettes de frein')
            ->setPrice(100)
            ->setDescription('Les plaquettes de frein sont un élément clé du système de freinage de tout véhicule.');

        $manager->persist($service3);

        // Service numéro 4

        $service4 = new Services();
        $service4->setServiceTitle('Vidange')
            ->setPrice(60)
            ->setDescription('La vidange de votre véhicule permet de vider.');

        $manager->persist($service4);

            // Service numéro 5

            $service5 = new Services();
            $service5->setServiceTitle('Kit de distribution')
                ->setPrice(60)
                ->setDescription('La rupture de la courroie de distribution');
    
            $manager->persist($service5);

            $manager->flush();

    }
}
