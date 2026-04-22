<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260418171609 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collection_field_config DROP type');
        $this->addSql('ALTER TABLE collection_field_config DROP related_to');
        $this->addSql('ALTER TABLE form_field_config DROP type');
        $this->addSql('ALTER TABLE form_field_config DROP related_to');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collection_field_config ADD type VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE collection_field_config ADD related_to VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE form_field_config ADD type VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE form_field_config ADD related_to VARCHAR(255) DEFAULT NULL');
    }
}
