<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Equipment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

require_once 'vendor/autoload.php';

class EquipmentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $equipment = new Equipment();
            $equipment->setEquipmentTitle($faker->word())
                    ->setDescription($faker->sentence());
            
            $manager->persist($equipment);
        }
        $manager->flush();

    }
}
