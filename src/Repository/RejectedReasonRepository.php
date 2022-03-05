<?php

namespace App\Repository;

use App\Entity\RejectedReason;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RejectedReason|null find($id, $lockMode = null, $lockVersion = null)
 * @method RejectedReason|null findOneBy(array $criteria, array $orderBy = null)
 * @method RejectedReason[]    findAll()
 * @method RejectedReason[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RejectedReasonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RejectedReason::class);
    }

    // /**
    //  * @return RejectedReason[] Returns an array of RejectedReason objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RejectedReason
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
