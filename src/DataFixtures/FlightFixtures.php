<?php
namespace App\DataFixtures;

ini_set('memory_limit', '1024M');

use App\Entity\Airline;
use App\Entity\Place;
use App\Entity\Flight;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FlightFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        (new PlaceFixtures())->load($manager);
        (new AirlineFixtures())->load($manager);

        $flights_array = [];
        if (($handle = fopen(__DIR__ . "/../../public/flights.csv", "r")) !== FALSE) {
            $flights_array[] = fgetcsv($handle, 1000, ",");
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                for ($i = 0; $i < count($data); $i++){
                    $data[$flights_array[0][$i]] = $data[$i];
                    unset($data[$i]);
                }
                array_push($flights_array, $data);
            }
            fclose($handle);
        }
        unset($flights_array[0]);
        var_dump(count($flights_array));
        $flights_array = array_slice($flights_array, 40000, 5000);
        var_dump(count($flights_array));

        foreach($flights_array as $flight){            
            $flight_object = new Flight();
            $flight_object
                ->setClass((int)$flight['class'])
                ->setTimeTaken($flight['time_taken'])
                ->setStop($flight['stop'])
                ->setStartTime(DateTimeImmutable::createFromFormat("H:i", trim($flight['dep_time'])))
                ->setEndTime(DateTimeImmutable::createFromFormat("H:i", trim($flight['arr_time'])))
                ->setAirline(($manager->getRepository(Airline::class)->findBy(["name" => $flight["airline"]])[0]))
                ->setFromPlace(($manager->getRepository(Place::class)->findBy(["name" => $flight["from"]]))[0])
                ->setToPlace(($manager->getRepository(Place::class)->findBy(["name" => $flight["to"]]))[0])
                ->setPrice(0);
            $manager->persist($flight_object);
        }
        $manager->flush();
    }
}