<?php

namespace App\Repository;

use App\Entity\Availability;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Availability>
 */
class AvailabilityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Availability::class);
    }

    public function findByCriteria($startDate, $endDate, $maxPrice)
    {
        $qb = $this->createQueryBuilder('a')
        ->join('a.vehicle', 'v')
        ->addSelect('v');
        $qb->where('a.startDate <= :startDate AND a.endDate >= :endDate')
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate);
    
        if ($maxPrice) {
            $qb->andWhere('a.pricePerDay <= :maxPrice')
               ->setParameter('maxPrice', $maxPrice);
        }
    
        return $qb->getQuery()->getResult();
    }
    
    public function findByDateRangeWithTolerance($startDate, $endDate, $maxPrice = null)
    {
            $qb = $this->createQueryBuilder('a');
        $toleranceBefore = (clone $startDate)->modify('-1 day');
        $toleranceAfter = (clone $endDate)->modify('+1 day');

        $qb->where('a.startDate <= :endAfter')
        ->andWhere('a.endDate >= :startBefore')
        ->setParameter('startBefore', $toleranceBefore)
        ->setParameter('endAfter', $toleranceAfter);

        if ($maxPrice !== null) {
            $qb->andWhere('a.pricePerDay <= :maxPrice')
            ->setParameter('maxPrice', $maxPrice);
    }

    return $qb->getQuery()->getResult();
    }

}
