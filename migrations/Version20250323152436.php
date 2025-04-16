<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250323152436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE permiso_permiso (permiso_source INT NOT NULL, permiso_target INT NOT NULL, PRIMARY KEY(permiso_source, permiso_target))');
        $this->addSql('CREATE INDEX IDX_EC89D1FFADFB42A8 ON permiso_permiso (permiso_source)');
        $this->addSql('CREATE INDEX IDX_EC89D1FFB41E1227 ON permiso_permiso (permiso_target)');
        $this->addSql('ALTER TABLE permiso_permiso ADD CONSTRAINT FK_EC89D1FFADFB42A8 FOREIGN KEY (permiso_source) REFERENCES permiso (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE permiso_permiso ADD CONSTRAINT FK_EC89D1FFB41E1227 FOREIGN KEY (permiso_target) REFERENCES permiso (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE permiso_permiso DROP CONSTRAINT FK_EC89D1FFADFB42A8');
        $this->addSql('ALTER TABLE permiso_permiso DROP CONSTRAINT FK_EC89D1FFB41E1227');
        $this->addSql('DROP TABLE permiso_permiso');
    }
}
