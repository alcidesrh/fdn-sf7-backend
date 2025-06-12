<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250504093921 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE action_role (action_id INT NOT NULL, role_id INT NOT NULL, PRIMARY KEY(action_id, role_id))');
        $this->addSql('CREATE INDEX IDX_218831649D32F035 ON action_role (action_id)');
        $this->addSql('CREATE INDEX IDX_21883164D60322AC ON action_role (role_id)');
        $this->addSql('ALTER TABLE action_role ADD CONSTRAINT FK_218831649D32F035 FOREIGN KEY (action_id) REFERENCES action (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE action_role ADD CONSTRAINT FK_21883164D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE action_role DROP CONSTRAINT FK_218831649D32F035');
        $this->addSql('ALTER TABLE action_role DROP CONSTRAINT FK_21883164D60322AC');
        $this->addSql('DROP TABLE action_role');
    }
}
