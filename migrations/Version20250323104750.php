<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250323104750 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE permiso_role (permiso_id INT NOT NULL, role_id INT NOT NULL, PRIMARY KEY(permiso_id, role_id))');
        $this->addSql('CREATE INDEX IDX_6648F726CEFAD37 ON permiso_role (permiso_id)');
        $this->addSql('CREATE INDEX IDX_6648F72D60322AC ON permiso_role (role_id)');
        $this->addSql('ALTER TABLE permiso_role ADD CONSTRAINT FK_6648F726CEFAD37 FOREIGN KEY (permiso_id) REFERENCES permiso (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE permiso_role ADD CONSTRAINT FK_6648F72D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE permiso_role DROP CONSTRAINT FK_6648F726CEFAD37');
        $this->addSql('ALTER TABLE permiso_role DROP CONSTRAINT FK_6648F72D60322AC');
        $this->addSql('DROP TABLE permiso_role');
    }
}
