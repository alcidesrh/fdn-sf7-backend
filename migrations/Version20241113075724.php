<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241113075724 extends AbstractMigration {
    public function getDescription(): string {
        return '';
    }

    public function up(Schema $schema): void {
        // this up() migration is auto-generated, please modify it to your needs

        $this->addSql('ALTER TABLE api_token DROP CONSTRAINT FK_7BA2F5EBDB38439E');
        $this->addSql('ALTER TABLE api_token ADD CONSTRAINT FK_7BA2F5EBDB38439E FOREIGN KEY (usuario_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');

        $this->addSql('ALTER TABLE api_token DROP CONSTRAINT fk_7ba2f5ebdb38439e');
        $this->addSql('ALTER TABLE api_token ADD CONSTRAINT fk_7ba2f5ebdb38439e FOREIGN KEY (usuario_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
