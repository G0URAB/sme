<?php

namespace App\Repository;

use App\Entity\MarketingStrategy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MarketingStrategy|null find($id, $lockMode = null, $lockVersion = null)
 * @method MarketingStrategy|null findOneBy(array $criteria, array $orderBy = null)
 * @method MarketingStrategy[]    findAll()
 * @method MarketingStrategy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarketingStrategyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MarketingStrategy::class);
    }

    // /**
    //  * @return MarketingStrategy[] Returns an array of MarketingStrategy objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MarketingStrategy
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
