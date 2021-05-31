<?php

namespace App\Repository;

use App\Entity\Deal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Deal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Deal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Deal[]    findAll()
 * @method Deal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DealRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Deal::class);
    }

    // /**
    //  * @return Deal[] Returns an array of Deal objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Deal
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getALaUne($dateAgo)
    {
        return $this->createQueryBuilder('d')
        ->andWhere('d.dateCreation > :dateAgo')
        ->setParameter('dateAgo', $dateAgo)
        ->select('COUNT(c) AS HIDDEN nbComm', 'd')
        ->leftJoin('d.commentaires', 'c')
        ->orderBy('nbComm', 'DESC')
        ->groupBy('d')
        ->getQuery()
        ->getResult()
    ;
    }

    public function getDealsHotJour()
    {
        $dateAgo = new \DateTime('-1 day');

        return $this->createQueryBuilder('d')
            ->andWhere('d.dateCreation > :dateAgo')
            ->setParameter('dateAgo', $dateAgo)
            ->addSelect('SUM(v.valeur) AS HIDDEN somme')
            ->leftJoin('d.votes', 'v')
            ->orderBy('somme',  'DESC')
            ->groupBy('d')
            ->getQuery()
            ->getResult()
            ;
    }
}
