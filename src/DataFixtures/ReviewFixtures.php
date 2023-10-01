<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Reviews;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

// require_once 'vendor/autoload.php';

class ReviewFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $reviews = new Reviews();
            $reviews->setAuthor($faker->name())
                    ->setComment($faker->sentence())
                    ->setNote($faker->numberBetween(0, 5))
                    ->setIsApproved(true);
            
            $manager->persist($reviews);
        }
        $manager->flush();

    }
}
