<?php

namespace App\Repository;

use App\Entity\LogRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LogRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method LogRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method LogRequest[]    findAll()
 * @method LogRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LogRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LogRequest::class);
    }

    // /**
    //  * @return LogRequest[] Returns an array of LogRequest objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LogRequest
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
