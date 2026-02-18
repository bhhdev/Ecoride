<?php

namespace App\Repository;

use App\Entity\Trip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TripRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trip::class);
    }

    public function findTrips(?string $departure, ?string $arrival, ?string $date): array
    {
        $qb = $this->createQueryBuilder('t')
            ->leftJoin('t.user', 'u')
            ->addSelect('u')

            ->andWhere('t.status != :cancelled')
            ->andWhere('t.seatAvailable > 0')
            ->setParameter('cancelled', 'cancelled');

        if (!empty($departure)) {
            $qb->andWhere('LOWER(t.departureCity) LIKE :departure')
               ->setParameter('departure', strtolower($departure) . '%');
        }

        if (!empty($arrival)) {
            $qb->andWhere('LOWER(t.arrivalCity) LIKE :arrival')
               ->setParameter('arrival', strtolower($arrival) . '%');
        }

        if (!empty($date)) {
            $start = new \DateTime($date . ' 00:00:00');
            $end   = new \DateTime($date . ' 23:59:59');

            $qb->andWhere('t.departureDay >= :start')
               ->andWhere('t.departureDay <= :end')
               ->setParameter('start', $start)
               ->setParameter('end', $end);
        }

        return $qb->orderBy('t.departureDay', 'ASC')
                  ->getQuery()
                  ->getResult();
    }
}
