<?php

namespace App\Repository;

use App\Entity\DeliveryConditions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DeliveryConditions|null find($id, $lockMode = null, $lockVersion = null)
 * @method DeliveryConditions|null findOneBy(array $criteria, array $orderBy = null)
 * @method DeliveryConditions[]    findAll()
 * @method DeliveryConditions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeliveryConditionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DeliveryConditions::class);
    }

    // /**
    //  * @return DeliveryConditions[] Returns an array of DeliveryConditions objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DeliveryConditions
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
