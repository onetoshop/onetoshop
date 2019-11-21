<?php

namespace App\Repository;

use App\Entity\Functionaliteitcard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Functionaliteitcard|null find($id, $lockMode = null, $lockVersion = null)
 * @method Functionaliteitcard|null findOneBy(array $criteria, array $orderBy = null)
 * @method Functionaliteitcard[]    findAll()
 * @method Functionaliteitcard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FunctionaliteitcardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Functionaliteitcard::class);
    }

    // /**
    //  * @return Functionaliteitcard[] Returns an array of Functionaliteitcard objects
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
    public function findOneBySomeField($value): ?Functionaliteitcard
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
