<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PropertyFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');
         for ($i = 1; $i <= 100; $i++) {
             $property= new Property();
             $property->setTitle($faker->words( 3, true))
                 ->setDescription($faker->sentences(3,true))
                 ->setPrice($faker->numberBetween(10000,90000))
                 ->setRooms($faker->numberBetween(2,10))
                 ->setBedrooms($faker->numberBetween(1,10))
                 ->setSurface($faker->numberBetween(80,1000))
                 ->setFloor($faker->numberBetween(0,15))
                 ->setAirConditioner($faker->numberBetween(0,count(Property::Heat)-1))
                 ->setCity($faker->city)
                 ->setAdress($faker->address)
                 ->setCodeZip($faker->postcode)
                 ->setSold(false);

              $manager->persist($property);
         }

        $manager->flush();
    }
}
