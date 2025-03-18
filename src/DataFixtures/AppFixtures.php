<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\AppUser as User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        Self::SetAdmins($manager);
        Self::SetTestUsers($manager);
        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setName('test' . $i);
            $user->setEmail('test' . $i . '@test.com');
            $user->setPassword(password_hash('123456', PASSWORD_DEFAULT));
            $user->setRoles(['ROLE_USER']);
            $manager->persist($user);
        }

        $manager->flush();
    }

    public static function SetTestUsers(ObjectManager $manager): void 
    {
        $user = new User();
        $user->setName('Test_User');
        $user->setEmail('Test@user.fr');
        $user->setRoles(['ROLE_TEST']);
        $user->setPassword(password_hash('Test', PASSWORD_DEFAULT));
        $manager->persist($user);
    }

    private static function SetAdmins(ObjectManager $manager): void
    {
        $user = new User();
        $user->setName('Maxime');
        $user->setEmail('maxime@admin.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword(password_hash('123456', PASSWORD_DEFAULT));
        $manager->persist($user);

        $user = new User();
        $user->setName('loic');
        $user->setEmail('loic@admin.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword(password_hash('123456', PASSWORD_DEFAULT));
        $manager->persist($user);


        $user = new User();
        $user->setName('Jalian');
        $user->setEmail('jalian@admin.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword(password_hash('123456', PASSWORD_DEFAULT));
        $manager->persist($user);
    }
}
