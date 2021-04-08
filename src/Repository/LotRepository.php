<?php

namespace App\Repository;

use App\Entity\Enchere;
use App\Entity\Lot;
use App\Entity\Vente;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @method Lot|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lot|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lot[]    findAll()
 * @method Lot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LotRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lot::class);
    }

    /**
     * @return QueryBuilder Returns an array of Lot objects
     */
//TODO fix cette fonction, pour éviter les erreurs qui viennent JSP D'Où :'(((((
    public function findByStartedAndNotEnded()
    {
        $dateNow = (new DateTime('now'));
//        $qb = new QueryBuilder($this->_em);
        $q = $this->createQueryBuilder('l');
        $q->join(Enchere::class, 'e')
            ->join(Vente::class, 'v')

//            ->expr()->andX(
//                 $q->expr()->gte((new DateTime("now"))->format('Y-m-d H:i:s'), 'v.dateStart'),
//                 $q->expr()->orX(
//                     $q->expr()->lt((new DateTime("now"))->format('Y-m-d H:i:s'), 'v.dateEnd'),
//                     $q->expr()->eq('v.dateEnd', 'NULL')
//                 )
//             )
            ->where(
                $q->expr()->andX(
                    $q->expr()->gte(':dateNow', 'v.dateStart'),
                    $q->expr()->orX(
                        $q->expr()->lt(':dateNow', 'v.dateEnd'),
                        $q->expr()->eq('v.dateEnd', 'NULL')
                    )
                )
            )

//            ->where('v.dateStart <= :dateNow')
            //->andWhere('(v.dateEnd > :dateNow) OR (v.dateEnd is NULL)')
            ->setParameter('dateNow', $dateNow)
            ->orderBy('v.dateStart', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();

        return $q;
    }
//                $q->expr()->andX(
//                $q->expr()->gte((new DateTime("now"))->format('Y-m-d H:i:s'), 'v.dateStart'),
//                $q->expr()->orX(
//                    $q->expr()->lt((new DateTime("now"))->format('Y-m-d H:i:s'), 'v.dateEnd'),
//                    $q->expr()->eq('v.dateEnd', 'NULL')
//                )
//           )

    /*
    public function findOneBySomeField($value): ?Lot
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
