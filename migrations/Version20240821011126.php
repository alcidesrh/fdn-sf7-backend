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
final class Version20240821011126 extends AbstractMigration implements DoctrineAwareMigrationInterface {

    private ManagerRegistry $doctrine;

    public function getDescription(): string {
        return '';
    }
    public function setDoctrine(ManagerRegistry $doctrine): void {
        $this->doctrine = $doctrine;
    }
    public function up(Schema $schema): void {
        // this up() migration is auto-generated, please modify it to your needs

        $em = $this->doctrine->getManager();

        foreach ($em->getRepository(User::class)->findAll() as $value) {

            $value->setApiID($value->getId());
        }
        $em->flush();
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs

        // $this->addSql('ALTER TABLE "user" DROP api_id');
    }
}
