<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;

class AppFixturesActor extends Fixture
{
    public function load(ObjectManager $manager): void
    { 
        $faker = Faker::create('fr_FR');
        for ($i=0 ;$i<20 ; $i++){
            $actor = new Actor();
            $actor->setName($faker->name);           
            $this->addReference('actor_' . $i, $actor);
            $manager->persist($actor);
    }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
    
}
