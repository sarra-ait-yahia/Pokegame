<?php

namespace App\Repository;

use App\Entity\CaptureLieu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CaptureLieu|null find($id, $lockMode = null, $lockVersion = null)
 * @method CaptureLieu|null findOneBy(array $criteria, array $orderBy = null)
 * @method CaptureLieu[]    findAll()
 * @method CaptureLieu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaptureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CaptureLieu::class);
    }

    /**
     * @return CaptureLieu[] Returns an array of CaptureLieu objects
      */

    public function findByExampleField($lieu)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.Lieu = :lieu ')
            ->setParameter(':lieu', $lieu)
            ->getQuery()
            ->getOneOrNullResult()
            ;

    }


    /*
    public function findOneBySomeField($value): ?CaptureLieu
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
