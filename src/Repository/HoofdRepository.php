<?php

namespace App\Repository;

use App\Entity\Hoofd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Hoofd|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hoofd|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hoofd[]    findAll()
 * @method Hoofd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HoofdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hoofd::class);
    }

    // /**
    //  * @return Hoofd[] Returns an array of Hoofd objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Hoofd
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
