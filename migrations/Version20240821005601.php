<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\User;
use App\Factory\DoctrineAwareMigrationInterface;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240821005601 extends AbstractMigration implements DoctrineAwareMigrationInterface {

    private ManagerRegistry $doctrine;

    public function getDescription(): string {
        return '';
    }
    public function setDoctrine(ManagerRegistry $doctrine): void {
        $this->doctrine = $doctrine;
    }
    public function up(Schema $schema): void {
        // $this->addSql('ALTER TABLE "user" ALTER api_id TYPE INT');
        // $this->connection->beginTransaction();
        // $em = $this->doctrine->getManager();

        // foreach ($em->getRepository(User::class)->findAll() as $value) {

        //     $value->setApiID($value->getId());
        // }
        // $em->flush();
    }

    public function down(Schema $schema): void {
        // $this->addSql('ALTER TABLE "user" ALTER api_id TYPE VARCHAR(255)');
    }
}
