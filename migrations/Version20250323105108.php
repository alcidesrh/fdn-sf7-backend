<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250323105108 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE permiso_user DROP CONSTRAINT fk_dc9ed3516cefad37');
        $this->addSql('ALTER TABLE permiso_user DROP CONSTRAINT fk_dc9ed351a76ed395');
        $this->addSql('DROP TABLE permiso_user');
        $this->addSql('ALTER TABLE permiso DROP CONSTRAINT fk_fd7aab9e613cec58');
        $this->addSql('DROP INDEX idx_fd7aab9e613cec58');
        $this->addSql('ALTER TABLE permiso DROP padre_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE permiso_user (permiso_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(permiso_id, user_id))');
        $this->addSql('CREATE INDEX idx_dc9ed351a76ed395 ON permiso_user (user_id)');
        $this->addSql('CREATE INDEX idx_dc9ed3516cefad37 ON permiso_user (permiso_id)');
        $this->addSql('ALTER TABLE permiso_user ADD CONSTRAINT fk_dc9ed3516cefad37 FOREIGN KEY (permiso_id) REFERENCES permiso (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE permiso_user ADD CONSTRAINT fk_dc9ed351a76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE permiso ADD padre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE permiso ADD CONSTRAINT fk_fd7aab9e613cec58 FOREIGN KEY (padre_id) REFERENCES permiso (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_fd7aab9e613cec58 ON permiso (padre_id)');
    }
}
