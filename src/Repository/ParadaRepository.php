<?php

namespace App\Repository;

use App\Entity\Parada;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Parada>
 *
 * @method Parada|null find($id, $lockMode = null, $lockVersion = null)
 * @method Parada|null findOneBy(array $criteria, array $orderBy = null)
 * @method Parada[]    findAll()
 * @method Parada[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParadaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Parada::class);
    }

//    /**
//     * @return Parada[] Returns an array of Parada objects
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

//    public function findOneBySomeField($value): ?Parada
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
