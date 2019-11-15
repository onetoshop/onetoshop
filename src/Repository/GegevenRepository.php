<?php

namespace App\Repository;

use App\Entity\Gegeven;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Gegeven|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gegeven|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gegeven[]    findAll()
 * @method Gegeven[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GegevenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gegeven::class);
    }

    // /**
    //  * @return Gegeven[] Returns an array of Gegeven objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gegeven
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
