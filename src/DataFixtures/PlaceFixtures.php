<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Place;

class PlaceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $cities_array = ['Bangalore', 'Delhi', 'Hyderabad', 'Kolkata', 'Chennai', 'Mumbai'];
        foreach($cities_array as $city){
            $place = new Place();
            $place
                ->setName($city)
                ->setType('city');
            $manager->persist($place);
        }        
        $manager->flush();
    }
}
