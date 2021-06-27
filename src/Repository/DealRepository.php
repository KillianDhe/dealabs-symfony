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

    public function getDealsByGroupeId($groupeId)
    {

        return $this->createQueryBuilder('d')
            ->leftJoin('d.votes', 'v')
            ->addSelect('SUM(v.valeur) AS HIDDEN somme')
            ->andWhere('g.id = :groupeId')
            ->setParameter('groupeId',$groupeId)
            ->leftJoin('d.groupes', 'g')
            ->orderBy('somme',  'DESC')
            ->groupBy('d')
            ->getQuery()
            ->getResult()
            ;
    }

    public function getDealsByPartenaireId($partenaireId)
    {

        return $this->createQueryBuilder('d')
            ->leftJoin('d.votes', 'v')
            ->addSelect('SUM(v.valeur) AS HIDDEN somme')
            ->andWhere('p.id = :partenaireId')
            ->setParameter('partenaireId',$partenaireId)
            ->leftJoin('d.partenaires', 'p')
            ->orderBy('somme',  'DESC')
            ->groupBy('d')
            ->getQuery()
            ->getResult()
            ;
    }

    public function search($search)
    {
        return $this->createQueryBuilder('d')
            ->where('d.Titre LIKE :search ')
            ->setParameter('search',"%".$search."%")
            ->orWhere('d.Description LIKE :searchD')
            ->setParameter('searchD',"%".$search."%")
            ->leftJoin('d.groupes', 'g')
            ->orWhere('g.nom LIKE :searchG')
            ->setParameter('searchG',"%".$search."%")
            ->leftJoin('d.partenaires','p')
            ->orWhere('p.nom LIKE :searchP')
            ->setParameter('searchP',"%".$search."%")
            ->getQuery()
            ->getResult()
            ;
    }

    public function getHottestDealByUser($email)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('author.email = :email ')
            ->setParameter('email',$email)
            ->addSelect('SUM(v.valeur) AS HIDDEN somme')
            ->leftJoin('d.votes', 'v')
            ->leftJoin('d.author', 'author')
            ->groupBy('d')
            ->setMaxResults(1)
            ->orderBy('somme',  'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function getAverageDealsSinceDate($email, $dateDebut)
    {
        $nbDeals =  $this->createQueryBuilder('d')->select('COUNT(d) as avg')-> andWhere('author.email = :email ')->leftJoin('d.author', 'author')->setParameter('email',$email)->getQuery()->getSingleScalarResult();

        return $this->createQueryBuilder('d')
            ->select('SUM(v.valeur) / :nbdeals as avg')
            ->setParameter('nbdeals',$nbDeals)
            ->andWhere('author.email = :email ')
            ->setParameter('email',$email)
            ->leftJoin('d.votes', 'v')
            ->leftJoin('d.author', 'author')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }



    public function hotDealsPercentage($email)
    {
        //marche pas, trop dur :(
        $nbDeals = $this->createQueryBuilder('d')->select('COUNT(d)')->andWhere('author.email = :email ')->leftJoin('d.author', 'author')->setParameter('email', $email)->getQuery()->getSingleScalarResult();

        return $this->createQueryBuilder('d')
            ->select('COUNT(d.id) /:nbDeals * 100')
            ->setParameter("nbDeals",$nbDeals)
            ->where('somme > 100')
            ->addSelect('SUM(v.valeur) AS HIDDEN somme')
            ->andWhere('author.email = :email ')
            ->setParameter('email', $email)
            ->leftJoin('d.votes', 'v')
            ->leftJoin('d.author', 'author')
            ->getQuery()
            ->getResult();
    }

    public function getDealsFromDate($date)
    {

        return $this->createQueryBuilder('d')
            ->where('d.dateCreation > :dateAgo')
            ->setParameter('dateAgo', $date)
            ->getQuery()
            ->getArrayResult();
    }

    /*public function getFavoritesDeals($user)
    {

        return $this->createQueryBuilder('d')
            ->where('d.usersSaved = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getArrayResult();
    }*/

    public function getDealsForAlert($alerte)
    {

        return $this->createQueryBuilder('d')
            ->andWhere('d.dateCreation > :dateAgo')
            ->setParameter('dateAgo', $alerte->getDateCreation())
            ->addSelect('SUM(v.valeur) AS HIDDEN somme')
            ->leftJoin('d.votes', 'v')
            ->andWhere('d.Titre LIKE :search ')
            ->setParameter('search',"%".$alerte->getRecherche()."%")
            ->orWhere('d.Description LIKE :searchD')
            ->setParameter('searchD',"%".$alerte->getRecherche()."%")
            ->leftJoin('d.groupes', 'g')
            ->orWhere('g.nom LIKE :searchG')
            ->setParameter('searchG',"%".$alerte->getRecherche()."%")
            ->leftJoin('d.partenaires','p')
            ->orWhere('p.nom LIKE :searchP')
            ->setParameter('searchP',"%".$alerte->getRecherche()."%")
            ->orderBy('d.dateCreation',  'DESC')
            ->groupBy('d')
            ->getQuery()
            ->getResult()
            ;
    }



}
