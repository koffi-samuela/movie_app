<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
class AppFixturesMovie extends Fixture
{
    public function load(ObjectManager $manager): void
    { 
        $faker = \Faker\Factory::create('fr_FR');
        for ($i=0 ;$i<20 ; $i++){
            $movie = new Movie();
            $movie->setName($faker->name);
            $movie -> setCreatedAt(new \DateTime('now - '.rand(1,100).' days')); // On ajoute un nombre de jours al
            $movie -> setReleaseDate($faker->dateTimeBetween('-5 years', 'now'));
            $movie -> setRate(rand(1,10));
            $movie->setDescription($faker->realText());
            $movie ->setImage($faker->imageUrl);
            $movie->setCategory($this->getReference('category_' .$faker->numberBetween(0,4)));
            $movie->addActor($this->getReference('actor_' .$faker->numberBetween(0,19)));
            $manager->persist($movie);
    }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
    public function getDependencies(){
        return [
            AppFixturesCategory::class 
        ];
        
    }
}

