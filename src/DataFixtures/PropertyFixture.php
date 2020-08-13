<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use LimitIterator;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpKernel\KernelInterface;



class PropertyFixture extends Fixture
{
    /**
     * @var KernelInterface
     */
    private $kernel;

    public function __construct(KernelInterface $kernel)
    {

        $this->kernel = $kernel;
    }

    public function load(ObjectManager $manager)
    {
        //dump(self::imageFinder());die;
        $faker= Factory::create('fr_FR');
         for ($i = 1; $i <= 100; $i++) {
             $property= new Property();

             // fetch the images in path : images/properties
             foreach (PropertyFixture::imageDirectory() as  $img){
                 $url = $this->kernel->getProjectDir().'/public/images/properties'.'/'.$img;
                 $file = file_get_contents($url); // To get file
                 $name = basename($url); // To get file name
                 $ext = pathinfo($url, PATHINFO_EXTENSION); // To get extension
                 $name2 =pathinfo($url, PATHINFO_FILENAME); // File name without extension
                 $fileFull=$name2.'.'.$ext;
//                 dump($fileFull);
             }
//             die;

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
//                 ->setImageName()
//                 ->setImageFile()
                 ->setSold(false);

              $manager->persist($property);
         }

        $manager->flush();
    }


    public function imageDirectory()
    {
        $imagesDir = $this->kernel->getProjectDir().'/public/images/properties';
        $listePhotos = array();
        if($listeFichiers = opendir($imagesDir)) {
            while(($file = readdir($listeFichiers)) !== false) {
                if( $file != '.' && $file != '..' && preg_match('#\.(jpe?g|gif|png)$#i', $file)) {
                    array_push($listePhotos, $file);
                }
            }
        }
        return $listeFichiers;
    }

    public function imageFinder()
    {
        $finder = new Finder();
        $files = $finder
            ->files()
//            ->in(__DIR__)
            ->in($this->kernel->getProjectDir().'/public/images/properties')
            ->sortByChangedTime()
            ->getIterator()
        ;

        foreach (new LimitIterator($files, 0, 5) as $file) {
             dump($file);
        }
    }
}
