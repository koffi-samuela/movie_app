<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ){

    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('johndoe@example.com');
        $user ->setFirstname( 'John' );
        $user -> setLastname( 'Doe' );
        $user -> setRoles( ['ROLE_ADMIN'] ) ;
        // The password used here is just for the example. It can be replaced with any other
        $hash = $this->passwordHasher->hashPassword( $user, 'secret' );
        $user -> setPassword( $hash );

        $manager->persist($user);

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
