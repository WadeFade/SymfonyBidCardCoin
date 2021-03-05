<?php

namespace App\Repository;

use App\Entity\SalleEnchere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SalleEnchere|null find($id, $lockMode = null, $lockVersion = null)
 * @method SalleEnchere|null findOneBy(array $criteria, array $orderBy = null)
 * @method SalleEnchere[]    findAll()
 * @method SalleEnchere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SalleEnchereRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SalleEnchere::class);
    }

    // /**
    //  * @return SalleEnchere[] Returns an array of SalleEnchere objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SalleEnchere
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
