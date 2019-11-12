<?php

namespace App\Repository;

use App\Entity\Testenah;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Testenah|null find($id, $lockMode = null, $lockVersion = null)
 * @method Testenah|null findOneBy(array $criteria, array $orderBy = null)
 * @method Testenah[]    findAll()
 * @method Testenah[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestenahRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Testenah::class);
    }

    // /**
    //  * @return Testenah[] Returns an array of Testenah objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Testenah
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
