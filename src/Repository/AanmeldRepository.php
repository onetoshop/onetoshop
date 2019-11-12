<?php

namespace App\Repository;

use App\Entity\Aanmeld;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Aanmeld|null find($id, $lockMode = null, $lockVersion = null)
 * @method Aanmeld|null findOneBy(array $criteria, array $orderBy = null)
 * @method Aanmeld[]    findAll()
 * @method Aanmeld[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AanmeldRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Aanmeld::class);
    }

    // /**
    //  * @return Aanmeld[] Returns an array of Aanmeld objects
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
    public function findOneBySomeField($value): ?Aanmeld
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
