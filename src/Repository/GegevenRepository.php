<?php

namespace App\Repository;

use App\Entity\Gegeven;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\ActivityRegistrations;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Gegeven|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gegeven|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gegeven[]    findAll()
 * @method Gegeven[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GegevenRepository extends ServiceEntityRepository
{
    /**
     * Entity manager
     */
    private $entityManager;



    public function __construct(RegistryInterface $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Gegeven::class);


        $this->entityManager = $entityManager;
    }

    public function getGroup($query)
    {
        return $this->getEntityManager()->createQuery('SELECT g FROM App\Entity\Gegeven g WHERE (\'g.group = :Klantbeheer\')')->getResult();
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
