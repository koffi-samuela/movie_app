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
        $categories = ['Action', 'Comédie','Drame',"Science-fiction","Thriller"];
        // On utilise le faker pour générer des données pseudo-aléa
        $faker = Faker::create('fr_FR');
        for ($i=0 ;$i<$categories.count($categories) ; $i++){
            $category = new Category();
            $category->setName($categories[$i]);
            $manager->persist($category);
    }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
