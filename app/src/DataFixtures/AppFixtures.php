<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Vehicle;
use App\Entity\Trip;
use App\Entity\Preference;
use App\Entity\Booking;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ){}

    public function load(ObjectManager $manager): void
    {
        $users = [];
        $drivers = [];
        $vehicles = [];

        // ✅ LISTE DES AVATARS RANDOM
        $avatars = [
            'bob.jpg',
            'christian.jpg',
            'julie.jpg',
            'kamel.jpg',
            'marie.jpg',
        ];

        // ===============================
        // 200 USERS
        // ===============================
        for ($i = 1; $i <= 200; $i++) {

            $isDriver = rand(0,1) === 1;

            $user = new User();
            $user->setEmail("user{$i}@example.com")
                 ->setFirstname("First{$i}")
                 ->setLastname("Last{$i}")
                 ->setPhone("06" . rand(10000000,99999999))
                 ->setCredits(rand(0,1000))
                 ->setIsPassenger(true)
                 ->setIsDriver($isDriver)
                 ->setPassword(
                     $this->passwordHasher->hashPassword(
                         $user,
                         "password{$i}"
                     )
                 );

            // ✅ RANDOM POUR TOUS
            $user->setAvatar($avatars[array_rand($avatars)]);

            $manager->persist($user);
            $users[] = $user;

            if ($isDriver) {
                $drivers[] = $user;
            }
        }

        // ===============================
        // 80 VEHICLES
        // ===============================
        $brands = ['Toyota','Renault','Peugeot','Ford','BMW','Audi','Tesla','Citroën'];
        $models = ['Corolla','Clio','308','Focus','320i','A3','Model 3','C3'];
        $energies = ['electric','gasoline','hybrid'];

        foreach ($drivers as $driver) {
            if (count($vehicles) >= 80) break;

            $vehicle = new Vehicle();
            $vehicle->setBrand($brands[array_rand($brands)])
                    ->setModel($models[array_rand($models)])
                    ->setNumberSeats(rand(2,7))
                    ->setEnergy($energies[array_rand($energies)])
                    ->setOwner($driver);

            $manager->persist($vehicle);
            $vehicles[] = $vehicle;
        }

        // ===============================
        // 100 FUTURE TRIPS
        // ===============================
        $cities = [
            ['Paris','12 Rue de Rivoli'],
            ['Lyon','45 Avenue Jean Jaurès'],
            ['Marseille','8 Boulevard Michelet'],
            ['Toulouse','22 Rue Alsace Lorraine'],
            ['Bordeaux','14 Quai des Chartrons'],
            ['Nantes','3 Rue Crébillon'],
            ['Lille','77 Rue Nationale'],
            ['Nice','9 Promenade des Anglais'],
            ['Strasbourg','5 Place Kléber'],
            ['Montpellier','18 Rue Foch']
        ];

        for ($i = 1; $i <= 100; $i++) {

            $vehicle = $vehicles[array_rand($vehicles)];
            $driver = $vehicle->getOwner();

            $days = rand(1,120);
            $hour = rand(6,22);
            $minute = rand(0,59);

            $departureDate = (new \DateTimeImmutable())
                ->modify("+{$days} days")
                ->setTime($hour,$minute);

            $arrivalDate = $departureDate
                ->modify('+' . rand(1,6) . ' hours');

            $departure = $cities[array_rand($cities)];
            do {
                $arrival = $cities[array_rand($cities)];
            } while ($arrival[0] === $departure[0]);

            $pref = new Preference();
            $pref->setAirConditioning(rand(0,1)===1)
                 ->setAnimalsAccepted(rand(0,1)===1)
                 ->setSmokeVap(false);
            $manager->persist($pref);

            $trip = new Trip();
            $trip->setUser($driver)
                 ->setVehicle($vehicle)
                 ->setPreference($pref)
                 ->setDepartureDay($departureDate)
                 ->setArrivalDay($arrivalDate)
                 ->setDepartureCity($departure[0])
                 ->setDepartureAddress($departure[1])
                 ->setArrivalCity($arrival[0])
                 ->setArrivalAddress($arrival[1])
                 ->setNumberSeats(rand(1,$vehicle->getNumberSeats()))
                 ->setSeatPrice(rand(15,120))
                 ->setStatus(rand(1,100)<=90 ? 'upcoming' : 'cancelled')
                 ->setUpdatedAt(new \DateTimeImmutable());

            $manager->persist($trip);
        }

        $manager->flush();
    }
}
