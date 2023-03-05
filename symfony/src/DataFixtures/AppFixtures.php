<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $chocolat = new Product();
        $chocolat->setName("Chocolat");
        $chocolat->setStockageCapacity(50);
        $chocolat->setStock(10);
        $chocolat->setPrice(3);
        $manager->persist($chocolat);

        $gingerBread = new Product();
        $gingerBread->setName("Pain d'épices");
        $gingerBread->setStockageCapacity(35);
        $gingerBread->setStock(35);
        $gingerBread->setPrice(6.75);
        $manager->persist($gingerBread);

        $cookie = new Product();
        $cookie->setName("Cookies");
        $cookie->setStockageCapacity(45);
        $cookie->setStock(20);
        $cookie->setPrice(4.50);
        $manager->persist($cookie);

        $manager->flush();
    }
}
