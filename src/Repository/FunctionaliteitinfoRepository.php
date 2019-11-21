<?php

namespace App\Repository;

use App\Entity\Functionaliteitinfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Functionaliteitinfo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Functionaliteitinfo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Functionaliteitinfo[]    findAll()
 * @method Functionaliteitinfo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FunctionaliteitinfoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Functionaliteitinfo::class);
    }

    // /**
    //  * @return Functionaliteitinfo[] Returns an array of Functionaliteitinfo objects
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
    public function findOneBySomeField($value): ?Functionaliteitinfo
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
