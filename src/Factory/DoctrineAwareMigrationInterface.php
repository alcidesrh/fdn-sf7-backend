<?php

namespace App\Factory;

use Doctrine\Persistence\ManagerRegistry;

interface DoctrineAwareMigrationInterface {

  public function setDoctrine(ManagerRegistry $doctrine): void;
}
