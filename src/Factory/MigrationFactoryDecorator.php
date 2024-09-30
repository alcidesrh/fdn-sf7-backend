<?php

declare(strict_types=1);

namespace App\Factory;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Migrations\Version\MigrationFactory;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;

#[AsDecorator('doctrine.migrations.migrations_factory')]
class MigrationFactoryDecorator implements MigrationFactory {

  public function __construct(private MigrationFactory $migrationFactory, private ManagerRegistry $doctrine) {
  }

  public function createVersion(string $migrationClassName): AbstractMigration {
    $instance = $this->migrationFactory->createVersion($migrationClassName);

    if ($instance instanceof DoctrineAwareMigrationInterface) {
      $instance->setDoctrine($this->doctrine);
    }

    return $instance;
  }
}
