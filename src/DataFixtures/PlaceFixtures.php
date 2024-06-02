<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Place;

class PlaceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $citiesArray = ['Bangalore', 'Delhi', 'Hyderabad', 'Kolkata', 'Chennai', 'Mumbai'];
        foreach($citiesArray as $city){
            $place = new Place();
            $place
                ->setName($city)
                ->setType('city');
            $manager->persist($place);
        }        
        $manager->flush();
    }
}
