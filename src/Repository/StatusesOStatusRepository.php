<?php

namespace App\Repository;

use App\Entity\StatusesOStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StatusesOStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatusesOStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatusesOStatus[]    findAll()
 * @method StatusesOStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatusesOStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatusesOStatus::class);
    }

    // /**
    //  * @return StatusesOStatus[] Returns an array of StatusesOStatus objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StatusesOStatus
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
