<?php

namespace App\Repository;

use App\Entity\KeyActivity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method KeyActivity|null find($id, $lockMode = null, $lockVersion = null)
 * @method KeyActivity|null findOneBy(array $criteria, array $orderBy = null)
 * @method KeyActivity[]    findAll()
 * @method KeyActivity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KeyActivityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, KeyActivity::class);
    }

    // /**
    //  * @return KeyActivity[] Returns an array of KeyActivity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?KeyActivity
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
