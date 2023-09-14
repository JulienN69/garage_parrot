<?php

namespace App\DataFixtures;

use App\Entity\Services;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    // public function load(ObjectManager $manager): void
    // {

    //     // Voiture numéro 1

    //     $car1 = new Car();
    //     $car1->setModele('volkswagen arteon')
    //         ->setPrice(32900)
    //         ->setMileage(83591);

    //     $date1 = new DateTime();
    //     $date1->setDate(2017, 11, 24);
    //     $date1->format('d/m/Y');

    //     $car1->setDateCreation($date1);
    //     $manager->persist($car1);

    //       // Voiture numéro 2

    //     $car2 = new Car();
    //     $car2->setModele('renault clio V');
    //     $car2->setPrice(18900);
    //     $car2->setMileage(22459);

    //     $date2 = new DateTime();
    //     $date2->setDate(2019, 9, 10);
    //     $date2->format('d/m/Y');

    //     $car2->setDateCreation($date2);
    //     $manager->persist($car2);

    //     // Voiture numéro 3

    //     $car3 = new Car();
    //     $car3->setModele('peugeot 3008 II phase 2');
    //     $car3->setPrice(29990);
    //     $car3->setMileage(59890);

    //     $date3 = new DateTime();
    //     $date3->setDate(2021, 7, 15);
    //     $date3->format('d/m/Y');

    //     $car3->setDateCreation($date3);
    //     $manager->persist($car3);

    //     $manager->flush();
    // }

    public function load(ObjectManager $manager): void
    {

        // Service numéro 1

        $service1 = new Services();
        $service1->setServiceTitle('Révision simple')
            ->setPrice(150)
            ->setDescription('La révision automobile consiste à examiner les différents composants de votre voiture grâce à des points de contrôle précis.
            Elle doit être effectuée à une fréquence régulière afin de préserver votre véhicule et d\'en garantir son bon fonctionnement.');

        $manager->persist($service1);

          // Service numéro 2

        $service2 = new Services();
        $service2->setServiceTitle('Révision complète')
            ->setPrice(300)
            ->setDescription('La révision automobile consiste à examiner les différents composants de votre voiture grâce à des points de contrôle précis.
            Elle doit être effectuée à une fréquence régulière afin de préserver votre véhicule et d\'en garantir son bon fonctionnement.');

        $manager->persist($service2);

        // Service numéro 3

        $service3 = new Services();
        $service3->setServiceTitle('Changement des plaquettes de frein')
            ->setPrice(100)
            ->setDescription('Les plaquettes de frein sont un élément clé du système de freinage de tout véhicule. Lorsque vous utilisez vos freins, les plaquettes exercent une pression hydraulique sur les disques de frein, ce qui ralentit votre voiture grâce à la friction et à la pression.
            Nous déterminerons quelles plaquettes de frein doivent être remplacées et nous en installerons de nouvelles si nécessaire.');

        $manager->persist($service3);

        // Service numéro 4

        $service4 = new Services();
        $service4->setServiceTitle('Vidange')
            ->setPrice(60)
            ->setDescription('La vidange de votre véhicule permet de vider l\'huile de moteur usée et de la remplacer par de l\'huile neuve.\
            L\'huile de moteur sert à maintenir tous les rouages ​​internes de votre moteur en bon état de fonctionnement et à l\'abri des dommages. 
            Elle protège les pièces mobiles du moteur en éliminant les frottements et, se faisant, prolonge leur durée de vie. Pour une dépense relativement faible, la vidange permet d\'optimiser le vieillissement de votre véhicule.');

        $manager->persist($service4);

        // Service numéro 5

        $service5 = new Services();
        $service5->setServiceTitle('Kit de distribution')
            ->setPrice(60)
            ->setDescription('La rupture de la courroie de distribution peut être brutale si la 
            périodicité de changement n\'est pas respectée et engendre systématiquement de graves 
            dommages sur le moteur.
            C\'est une pièce essentielle dans son fonctionnement puisqu\'elle assure la synchronisation 
            entre la partie haute et basse du moteur.     
            Pour cette raison, elle doit être remplacée de façon préventive selon les préconisations 
            du constructeur.');

        $manager->persist($service5);

        $manager->flush();


    }
}

