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
            L\'huile de moteur sert à maintenir tous les rouages ​​internes de votre moteur en bon état de fonctionnement et à l\'abri des dommages.');

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


    }
}
