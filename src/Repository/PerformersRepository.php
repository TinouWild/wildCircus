<?php

namespace App\Repository;

use App\Entity\Performers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Performers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Performers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Performers[]    findAll()
 * @method Performers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerformersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Performers::class);
    }

    // /**
    //  * @return Performers[] Returns an array of Performers objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Performers
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
