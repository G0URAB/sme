<?php

namespace App\Repository;

use App\Entity\CustomerSegment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CustomerSegment|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerSegment|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerSegment[]    findAll()
 * @method CustomerSegment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerSegmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerSegment::class);
    }

    // /**
    //  * @return CustomerSegment[] Returns an array of CustomerSegment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CustomerSegment
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
