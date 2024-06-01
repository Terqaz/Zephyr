<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin
            ->setName('admin')
            ->setEmail('admin@test.test')
            ->setRoles(['ROLE_SUPER_ADMIN']);
        $admin->setPassword($this->passwordHasher->hashPassword(
            $admin,
            'admin_password'
        ));
        $manager->persist($admin);

        $manager->flush();
    }
}
