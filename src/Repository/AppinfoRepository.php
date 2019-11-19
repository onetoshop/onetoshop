<?php

namespace App\Repository;

use App\Entity\Appinfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Appinfo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Appinfo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Appinfo[]    findAll()
 * @method Appinfo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppinfoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Appinfo::class);
    }

    // /**
    //  * @return Appinfo[] Returns an array of Appinfo objects
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
    public function findOneBySomeField($value): ?Appinfo
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
