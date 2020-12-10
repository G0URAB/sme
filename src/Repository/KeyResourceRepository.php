<?php

namespace App\Repository;

use App\Entity\KeyResource;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method KeyResource|null find($id, $lockMode = null, $lockVersion = null)
 * @method KeyResource|null findOneBy(array $criteria, array $orderBy = null)
 * @method KeyResource[]    findAll()
 * @method KeyResource[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KeyResourceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, KeyResource::class);
    }

    // /**
    //  * @return KeyResource[] Returns an array of KeyResource objects
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
    public function findOneBySomeField($value): ?KeyResource
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
