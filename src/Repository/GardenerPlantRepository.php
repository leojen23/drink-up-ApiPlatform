<?php

namespace App\Repository;

use App\Entity\GardenerPlant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GardenerPlant|null find($id, $lockMode = null, $lockVersion = null)
 * @method GardenerPlant|null findOneBy(array $criteria, array $orderBy = null)
 * @method GardenerPlant[]    findAll()
 * @method GardenerPlant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GardenerPlantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GardenerPlant::class);
    }

    // /**
    //  * @return GardenerPlant[] Returns an array of GardenerPlant objects
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
    public function findOneBySomeField($value): ?GardenerPlant
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
