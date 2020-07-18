<?php

namespace App\DataFixtures;

use App\Entity\Option;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class OptionFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');
        $categories=['balcon','ascenseur','piscine','nettoyage','garage'];
        foreach ( $categories as $category) {
            $option= new Option();
             $option->setName($category)
                    ->setDescription($faker->sentences(1,true));
              $manager->persist($option);
         }

        $manager->flush();
    }
}
