<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250326155835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu_deny_user (menu_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(menu_id, user_id))');
        $this->addSql('CREATE INDEX IDX_87FD3713CCD7E912 ON menu_deny_user (menu_id)');
        $this->addSql('CREATE INDEX IDX_87FD3713A76ED395 ON menu_deny_user (user_id)');
        $this->addSql('ALTER TABLE menu_deny_user ADD CONSTRAINT FK_87FD3713CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE menu_deny_user ADD CONSTRAINT FK_87FD3713A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu_deny_user DROP CONSTRAINT FK_87FD3713CCD7E912');
        $this->addSql('ALTER TABLE menu_deny_user DROP CONSTRAINT FK_87FD3713A76ED395');
        $this->addSql('DROP TABLE menu_deny_user');
    }
}
