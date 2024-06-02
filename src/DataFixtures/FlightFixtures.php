<?php

namespace App\DataFixtures;

ini_set('memory_limit', '1024M');

use App\Entity\Airline;
use App\Entity\Place;
use App\Entity\Flight;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class FlightFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $flights = [];
        if (($handle = fopen(__DIR__ . "/../../public/flights.csv", "r")) !== FALSE) {
            $flights[] = fgetcsv($handle, 1000, ",");
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                for ($i = 0; $i < count($data); $i++) {
                    $data[$flights[0][$i]] = $data[$i];
                    unset($data[$i]);
                }
                array_push($flights, $data);
            }
            fclose($handle);
        }
        unset($flights[0]);
        var_dump(count($flights));
        $flights = array_slice($flights, 40000, 5000);
        var_dump(count($flights));

        foreach ($flights as $flight) {
            $flightObj = new Flight();
            $flightObj
                ->setClass((int)$flight['class'])
                ->setTimeTaken($flight['time_taken'])
                ->setStop($flight['stop'])
                ->setStartTime(DateTimeImmutable::createFromFormat("H:i", trim($flight['dep_time'])))
                ->setEndTime(DateTimeImmutable::createFromFormat("H:i", trim($flight['arr_time'])))
                ->setAirline(($manager->getRepository(Airline::class)->findBy(["name" => $flight["airline"]])[0]))
                ->setFromPlace(($manager->getRepository(Place::class)->findBy(["name" => $flight["from"]]))[0])
                ->setToPlace(($manager->getRepository(Place::class)->findBy(["name" => $flight["to"]]))[0])
                ->setPrice(0);
            $manager->persist($flightObj);
        
        $manager->flush();
    }
}
