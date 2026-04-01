<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260316075036 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE form_field_config ADD visible BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE form_field_config ADD label VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE list_field_config ALTER visible DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE form_field_config DROP visible');
        $this->addSql('ALTER TABLE form_field_config DROP label');
        $this->addSql('ALTER TABLE list_field_config ALTER visible SET NOT NULL');
    }
}
