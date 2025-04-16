<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250322080431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE role_role DROP CONSTRAINT fk_e9d6f8fef4ac9ec2');
        $this->addSql('ALTER TABLE role_role DROP CONSTRAINT fk_e9d6f8feed49ce4d');
        $this->addSql('DROP TABLE role_role');
        $this->addSql('ALTER TABLE role ADD parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6A727ACA70 FOREIGN KEY (parent_id) REFERENCES role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_57698A6A727ACA70 ON role (parent_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE role_role (role_source INT NOT NULL, role_target INT NOT NULL, PRIMARY KEY(role_source, role_target))');
        $this->addSql('CREATE INDEX idx_e9d6f8feed49ce4d ON role_role (role_target)');
        $this->addSql('CREATE INDEX idx_e9d6f8fef4ac9ec2 ON role_role (role_source)');
        $this->addSql('ALTER TABLE role_role ADD CONSTRAINT fk_e9d6f8fef4ac9ec2 FOREIGN KEY (role_source) REFERENCES role (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE role_role ADD CONSTRAINT fk_e9d6f8feed49ce4d FOREIGN KEY (role_target) REFERENCES role (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE role DROP CONSTRAINT FK_57698A6A727ACA70');
        $this->addSql('DROP INDEX IDX_57698A6A727ACA70');
        $this->addSql('ALTER TABLE role DROP parent_id');
    }
}
