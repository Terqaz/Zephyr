<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Airline;

class AirlineFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $airlines_array = ['GO FIRST', 'Air India', 'Indigo', 'Vistara'];
        foreach($airlines_array as $airline){
            $airline_object = new Airline();
            $airline_object->setName($airline);
            $manager->persist($airline_object);
        }        
        $manager->flush();
    }
}
