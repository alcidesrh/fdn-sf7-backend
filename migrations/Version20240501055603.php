<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240501055603 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu_item (link VARCHAR(100) DEFAULT NULL, slug VARCHAR(128) NOT NULL, id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D754D550989D9B62 ON menu_item (slug)');
        $this->addSql('CREATE TABLE taxon (nombre VARCHAR(255) DEFAULT NULL, nota TEXT DEFAULT NULL, status SMALLINT NOT NULL, posicion SMALLINT DEFAULT NULL, parent_id INT DEFAULT NULL, id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5B6723AB727ACA70 ON taxon (parent_id)');
        $this->addSql('CREATE TABLE taxon_taxon (taxon_source INT NOT NULL, taxon_target INT NOT NULL, PRIMARY KEY(taxon_source, taxon_target))');
        $this->addSql('CREATE INDEX IDX_E2FD752555334B02 ON taxon_taxon (taxon_source)');
        $this->addSql('CREATE INDEX IDX_E2FD75254CD61B8D ON taxon_taxon (taxon_target)');
        $this->addSql('ALTER TABLE menu_item ADD CONSTRAINT FK_D754D550BF396750 FOREIGN KEY (id) REFERENCES fdn (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE taxon ADD CONSTRAINT FK_5B6723AB727ACA70 FOREIGN KEY (parent_id) REFERENCES taxon (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE taxon ADD CONSTRAINT FK_5B6723ABBF396750 FOREIGN KEY (id) REFERENCES fdn (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE taxon_taxon ADD CONSTRAINT FK_E2FD752555334B02 FOREIGN KEY (taxon_source) REFERENCES taxon (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE taxon_taxon ADD CONSTRAINT FK_E2FD75254CD61B8D FOREIGN KEY (taxon_target) REFERENCES taxon (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE menu_item DROP CONSTRAINT FK_D754D550BF396750');
        $this->addSql('ALTER TABLE taxon DROP CONSTRAINT FK_5B6723AB727ACA70');
        $this->addSql('ALTER TABLE taxon DROP CONSTRAINT FK_5B6723ABBF396750');
        $this->addSql('ALTER TABLE taxon_taxon DROP CONSTRAINT FK_E2FD752555334B02');
        $this->addSql('ALTER TABLE taxon_taxon DROP CONSTRAINT FK_E2FD75254CD61B8D');
        $this->addSql('DROP TABLE menu_item');
        $this->addSql('DROP TABLE taxon');
        $this->addSql('DROP TABLE taxon_taxon');
    }
}
