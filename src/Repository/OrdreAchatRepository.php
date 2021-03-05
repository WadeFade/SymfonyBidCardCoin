<?php

namespace App\Repository;

use App\Entity\OrdreAchat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OrdreAchat|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrdreAchat|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrdreAchat[]    findAll()
 * @method OrdreAchat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdreAchatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrdreAchat::class);
    }

    // /**
    //  * @return OrdreAchat[] Returns an array of OrdreAchat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrdreAchat
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
