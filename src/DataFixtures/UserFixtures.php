<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
// ...

class UserFixtures extends Fixture
{
    private $passwordEncoder;

   public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
       $this->passwordEncoder = $passwordEncoder;
     }

    public function load(ObjectManager $manager)
{
    $user = new User();
    // ...

             $user->setPassword($this->passwordEncoder-> encodePassword(
                     $user, 'test123'));
            $user->setEmail('jesse@gmail.com');

    $manager->persist($user);

    // add more products

    $manager->flush();


}
}
