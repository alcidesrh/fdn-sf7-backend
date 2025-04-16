<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250313004110 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu_menu DROP CONSTRAINT fk_b54acadd8ccd27ab');
        $this->addSql('ALTER TABLE menu_menu DROP CONSTRAINT fk_b54acadd95287724');
        $this->addSql('DROP TABLE menu_menu');
        $this->addSql('ALTER TABLE localidad DROP CONSTRAINT fk_4f68e010c604d5c6');
        $this->addSql('DROP INDEX idx_4f68e010c604d5c6');
        $this->addSql('ALTER TABLE localidad RENAME COLUMN pais_id TO nacion_id');
        $this->addSql('ALTER TABLE localidad ADD CONSTRAINT FK_4F68E010A2D79AD9 FOREIGN KEY (nacion_id) REFERENCES pais (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_4F68E010A2D79AD9 ON localidad (nacion_id)');
        $this->addSql('ALTER TABLE "user" ALTER roles DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu_menu (menu_source INT NOT NULL, menu_target INT NOT NULL, PRIMARY KEY(menu_source, menu_target))');
        $this->addSql('CREATE INDEX idx_b54acadd95287724 ON menu_menu (menu_target)');
        $this->addSql('CREATE INDEX idx_b54acadd8ccd27ab ON menu_menu (menu_source)');
        $this->addSql('ALTER TABLE menu_menu ADD CONSTRAINT fk_b54acadd8ccd27ab FOREIGN KEY (menu_source) REFERENCES menu (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE menu_menu ADD CONSTRAINT fk_b54acadd95287724 FOREIGN KEY (menu_target) REFERENCES menu (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ALTER roles SET NOT NULL');
        $this->addSql('ALTER TABLE localidad DROP CONSTRAINT FK_4F68E010A2D79AD9');
        $this->addSql('DROP INDEX IDX_4F68E010A2D79AD9');
        $this->addSql('ALTER TABLE localidad RENAME COLUMN nacion_id TO pais_id');
        $this->addSql('ALTER TABLE localidad ADD CONSTRAINT fk_4f68e010c604d5c6 FOREIGN KEY (pais_id) REFERENCES pais (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_4f68e010c604d5c6 ON localidad (pais_id)');
    }
}
