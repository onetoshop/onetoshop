<?php

namespace App\Repository;

use App\Entity\Nieuwsbrief;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Nieuwsbrief|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nieuwsbrief|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nieuwsbrief[]    findAll()
 * @method Nieuwsbrief[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NieuwsbriefRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nieuwsbrief::class);
    }

    // /**
    //  * @return Nieuwsbrief[] Returns an array of Nieuwsbrief objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Nieuwsbrief
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
