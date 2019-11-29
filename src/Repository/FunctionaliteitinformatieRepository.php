<?php

namespace App\Repository;

use App\Entity\Functionaliteitinformatie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Functionaliteitinformatie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Functionaliteitinformatie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Functionaliteitinformatie[]    findAll()
 * @method Functionaliteitinformatie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FunctionaliteitinformatieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Functionaliteitinformatie::class);
    }

    // /**
    //  * @return Functionaliteitinformatie[] Returns an array of Functionaliteitinformatie objects
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
    public function findOneBySomeField($value): ?Functionaliteitinformatie
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
