<?php

namespace App\Repository;

use App\Entity\ValueProposition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ValueProposition|null find($id, $lockMode = null, $lockVersion = null)
 * @method ValueProposition|null findOneBy(array $criteria, array $orderBy = null)
 * @method ValueProposition[]    findAll()
 * @method ValueProposition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ValuePropositionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ValueProposition::class);
    }

    // /**
    //  * @return ValueProposition[] Returns an array of ValueProposition objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ValueProposition
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
