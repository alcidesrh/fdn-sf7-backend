<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240821080830 extends AbstractMigration {
    public function getDescription(): string {
        return '';
    }

    public function up(Schema $schema): void {

        $this->addSql('ALTER TABLE "user" DROP api_id');
    }

    public function down(Schema $schema): void {

        $this->addSql('ALTER TABLE "user" ADD api_id INT NOT NULL');
    }
}
