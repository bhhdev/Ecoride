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
        $vehicles = [];

        // 5 utilisateurs
        for ($i=1; $i<=5; $i++) {
            $user = new User();
            $user->setEmail("user{$i}@example.com")
                 ->setFirstname("First{$i}")
                 ->setLastname("Last{$i}")
                 ->setPhone("06000000{$i}")
                 ->setCredits(rand(0,1000))
                 ->setIsPassenger(true)
                 ->setIsDriver(false);
            $plaintextPassword = "password{$i}";
            $user->setPassword($this->passwordHasher->hashPassword($user, $plaintextPassword));
            $manager->persist($user);
            $users[] = $user;
        }

        // 5 véhicules
        $brands = ['Toyota','Renault','Peugeot','Ford','BMW'];
        $models = ['Corolla','Clio','308','Focus','320i'];
        foreach ($brands as $idx => $brand) {
            $v = new Vehicle();
            $v->setBrand($brand)
              ->setModel($models[$idx])
              ->setSeats(rand(2,5))
              ->setOwner($users[$idx]);
            $users[$idx]->setIsDriver(true);
            $manager->persist($v);
            $vehicles[] = $v;
        }

        // 10 trips
        for ($i=1;$i<=10;$i++){
            $pref = new Preference();
            $pref->setAirConditioning(rand(0,1)==1)
                 ->setAnimalsAccepted(rand(0,1)==1)
                 ->setSmokeVap(rand(0,1)==1);

            $trip = new Trip();
            $trip->setUser($users[array_rand($users)])
                 ->setVehicle($vehicles[array_rand($vehicles)])
                 ->setPreference($pref);

            $manager->persist($pref);
            $manager->persist($trip);

            // 0 à n bookings
            $numBookings = rand(0, $trip->getNumberSeats());
            for ($b=0;$b<$numBookings;$b++){
                $booking = new Booking();
                $booking->setTrip($trip)
                        ->setUser($users[array_rand($users)])
                        ->setSeatNumber(1);
                $manager->persist($booking);
            }
        }

        $manager->flush();
    }
}
