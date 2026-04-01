<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260317120706 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE form_field_config ADD type VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE form_field_config RENAME COLUMN field_name TO field');
        $this->addSql('ALTER TABLE form_field_config RENAME COLUMN input_props TO attrs');
        $this->addSql('ALTER TABLE list_field_config ADD type VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE list_field_config ADD attrs JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE list_field_config RENAME COLUMN field_name TO field');
        $this->addSql('ALTER TABLE list_field_config RENAME COLUMN filterable TO sortable');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE form_field_config DROP type');
        $this->addSql('ALTER TABLE form_field_config RENAME COLUMN field TO field_name');
        $this->addSql('ALTER TABLE form_field_config RENAME COLUMN attrs TO input_props');
        $this->addSql('ALTER TABLE list_field_config DROP type');
        $this->addSql('ALTER TABLE list_field_config DROP attrs');
        $this->addSql('ALTER TABLE list_field_config RENAME COLUMN field TO field_name');
        $this->addSql('ALTER TABLE list_field_config RENAME COLUMN sortable TO filterable');
    }
}
