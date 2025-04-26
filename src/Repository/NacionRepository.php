<?php

namespace App\Repository;

use App\Entity\Nacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends CustomEntityRepository<Nacion>
 *
 * @method Nacion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nacion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nacion[]    findAll()
 * @method Nacion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NacionRepository extends CustomEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Nacion::class);
    }

    //    /**
    //     * @return Nacion[] Returns an array of Nacion objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Nacion
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
