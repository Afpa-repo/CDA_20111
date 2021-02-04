<?php
namespace App\Repository;

use App\Entity\Pointretrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pointretrait|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pointretrait|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pointretrait[]    findAll()
 * @method Pointretrait[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */



class PointretraitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pointretrait::class);
    }

    // /**
    //  * @return Pointretrait[] Returns an array of Pointretrait objects
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
    //  * @return Pointretrait[] Returns an array of Pointretrait objects
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
    public function findOneBySomeField($value): ?Pointretrait
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