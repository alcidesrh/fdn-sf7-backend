<?php

namespace App\Repository;

use App\Entity\Menu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends CustomEntityRepository<Menu>
 */
class CustomEntityRepository extends ServiceEntityRepository {
  public function __construct(ManagerRegistry $registry) {
    parent::__construct($registry, Menu::class);
  }
  public function save($object) {
    $em = $this->getEntityManager();
    $em->persist($object);
    $em->flush();
  }
}
