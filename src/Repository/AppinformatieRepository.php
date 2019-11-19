<?php

namespace App\Repository;

use App\Entity\Appinformatie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Appinformatie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Appinformatie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Appinformatie[]    findAll()
 * @method Appinformatie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppinformatieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Appinformatie::class);
    }

    // /**
    //  * @return Appinformatie[] Returns an array of Appinformatie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Appinformatie
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
