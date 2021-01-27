<?php

namespace App\Repository;

use App\Entity\PointRetrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PointRetrait|null find($id, $lockMode = null, $lockVersion = null)
 * @method PointRetrait|null findOneBy(array $criteria, array $orderBy = null)
 * @method PointRetrait[]    findAll()
 * @method PointRetrait[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PointRetraitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PointRetrait::class);
    }

    // /**
    //  * @return PointRetrait[] Returns an array of PointRetrait objects
    //  */

    public function findAllOrdered($orderedBy, $orderType = 'ASC')
    {
        return $this->createQueryBuilder('pr')
            ->orderBy('pr.'.$orderedBy, $orderType)
            ->getQuery()
            ->getResult()
        ;
    }



    // /**
    //  * @return PointRetrait[] Returns an array of PointRetrait objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PointRetrait
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
