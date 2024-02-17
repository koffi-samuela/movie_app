<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;
// use Symfony\Component\Validator\Constraints\Length;

class AppFixturesCategory extends Fixture
{
    public function load(ObjectManager $manager): void
    { 
        // $faker = Faker::create('fr_FR');

        $categories = ['Action', 'Comédie','Drame','Science-fiction','Thriller'];
        // On utilise le faker pour générer des données pseudo-aléa
        // $faker = Faker::create('fr_FR');
        for ($i=0 ;$i<5 ; $i++){
            $category = new Category();
            $category->setName($categories[$i]);
            $this->addReference('category_' . $i, $category);
            $manager->persist($category);
    }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
