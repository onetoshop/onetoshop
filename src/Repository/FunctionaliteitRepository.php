<?php

namespace App\Repository;

use App\Entity\Functionaliteit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Functionaliteit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Functionaliteit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Functionaliteit[]    findAll()
 * @method Functionaliteit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FunctionaliteitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Functionaliteit::class);
    }

    // /**
    //  * @return Functionaliteit[] Returns an array of Functionaliteit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Functionaliteit
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
