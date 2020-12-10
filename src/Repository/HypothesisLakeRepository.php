<?php

namespace App\Repository;

use App\Entity\HypothesisLake;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HypothesisLake|null find($id, $lockMode = null, $lockVersion = null)
 * @method HypothesisLake|null findOneBy(array $criteria, array $orderBy = null)
 * @method HypothesisLake[]    findAll()
 * @method HypothesisLake[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HypothesisLakeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HypothesisLake::class);
    }

    // /**
    //  * @return HypothesisLake[] Returns an array of HypothesisLake objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HypothesisLake
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
