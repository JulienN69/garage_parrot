<?php

namespace App\DataFixtures;

use App\Entity\Car;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTime;

class CarFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {

        // Voiture numéro 1

        $car1 = new Car();
        $car1->setModele('volkswagen arteon')
            ->setPrice(32900)
            ->setMileage(83591);

        $date1 = new DateTime();
        $date1->setDate(2017, 11, 24);
        $date1->format('d/m/Y');

        $car1->setDateCreation($date1);
        $manager->persist($car1);

        // Voiture numéro 2

        $car2 = new Car();
        $car2->setModele('renault clio V');
        $car2->setPrice(18900);
        $car2->setMileage(22459);

        $date2 = new DateTime();
        $date2->setDate(2019, 9, 10);
        $date2->format('d/m/Y');

        $car2->setDateCreation($date2);
        $manager->persist($car2);

        // Voiture numéro 3

        $car3 = new Car();
        $car3->setModele('peugeot 3008 II phase 2');
        $car3->setPrice(29990);
        $car3->setMileage(59890);

        $date3 = new DateTime();
        $date3->setDate(2021, 7, 15);
        $date3->format('d/m/Y');

        $car3->setDateCreation($date3);
        $manager->persist($car3);

        $manager->flush();

    }
}
