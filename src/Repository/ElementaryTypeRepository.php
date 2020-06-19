<?php

namespace App\Repository;

use App\Entity\ElementaryType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ElementaryType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ElementaryType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ElementaryType[]    findAll()
 * @method ElementaryType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ElementaryTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ElementaryType::class);
    }

    public function findByExampleField($lieu)
    {
        $repository = $this->getDoctrine()
            ->getRepository(ElementaryType::class);



    }
    // /**
    //  * @return ElementaryType[] Returns an array of ElementaryType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ElementaryType
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
