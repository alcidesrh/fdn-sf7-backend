<?php

namespace App\Repository;

use App\Entity\Estacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Estacion>
 *
 * @method Estacion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Estacion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Estacion[]    findAll()
 * @method Estacion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstacionRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Estacion::class);
    }

    //    /**
    //     * @return Estacion[] Returns an array of Estacion objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Estacion
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
