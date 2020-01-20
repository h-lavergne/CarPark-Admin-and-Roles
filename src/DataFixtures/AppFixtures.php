<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Car;
use App\Entity\CarModel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $brand1 = new Brand();
        $brand1->setWording("Toyota");
        $manager->persist($brand1);

        $brand2 = new Brand();
        $brand2->setWording("Peujo");
        $manager->persist($brand2);

        $carModel1 = new CarModel();
        $carModel1->setWording("Luffy")
            ->setImage("modele1.jpg")
            ->setAveragePrice(15000)
            ->setBrand($brand1);
        $manager->persist($carModel1);

        $carModel2 = new CarModel();
        $carModel2->setWording("Roronoa Zoro")
            ->setImage("modele2.jpg")
            ->setAveragePrice(14000)
            ->setBrand($brand1);
        $manager->persist($carModel2);

        $carModel3 = new CarModel();
        $carModel3->setWording("Jinbei")
            ->setImage("modele3.jpg")
            ->setAveragePrice(11000)
            ->setBrand($brand2);
        $manager->persist($carModel3);

        $carModel4 = new CarModel();
        $carModel4->setWording("Brook")
            ->setImage("modele4.jpg")
            ->setAveragePrice(9000)
            ->setBrand($brand2);
        $manager->persist($carModel4);

        $carModel5 = new CarModel();
        $carModel5->setWording("Shanks")
            ->setImage("modele5.jpg")
            ->setAveragePrice(18000)
            ->setBrand($brand1);
        $manager->persist($carModel5);

        $faker = \Faker\Factory::create("fr_FR");

        $carModels = [$carModel1, $carModel2, $carModel3, $carModel4, $carModel5];
        foreach ($carModels as $m) {
            $rand = rand(3, 5);
            for ($i=1; $i <= $rand; $i++){
                $car = new Car();
                $car->setImmatriculation($faker->regexify("[A-Z]{2}[0-9]{3,4}[A-Z]{2}"))
                    ->setDoorNumber($faker->randomElement($array = array(3, 5)))
                    ->setYear($faker->numberBetween($min= 1990, $max = 2020))
                    ->setCarModel($m);
                $manager->persist($car);
            }
        }

        $manager->flush();
    }
}
