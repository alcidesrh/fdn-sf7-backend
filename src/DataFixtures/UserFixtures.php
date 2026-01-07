<?php

namespace App\DataFixtures;

use App\Entity\User as EntityUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture {
    public function load(ObjectManager $manager): void {
        // $product = new Product();
        // $manager->persist($product);
        // foreach ($manager->getRepository(EntityUser::class)->findAll() as $value) {
        // $value->setApiID($value->getId());
        # code...
        // }

        // $manager->flush();
    }
}
