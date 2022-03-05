<?php

namespace App\Repository\Statuses;

use App\Entity\Statuses\CStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method CStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method CStatus[]    findAll()
 * @method CStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CStatus::class);
    }

    // /**
    //  * @return CStatus[] Returns an array of CStatus objects
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
    public function findOneBySomeField($value): ?CStatus
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
