<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260307091821 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE role_permiso (role_id INT NOT NULL, permiso_id INT NOT NULL, PRIMARY KEY (role_id, permiso_id))');
        $this->addSql('CREATE INDEX IDX_41B70E65D60322AC ON role_permiso (role_id)');
        $this->addSql('CREATE INDEX IDX_41B70E656CEFAD37 ON role_permiso (permiso_id)');
        $this->addSql('CREATE TABLE role_action (role_id INT NOT NULL, action_id INT NOT NULL, PRIMARY KEY (role_id, action_id))');
        $this->addSql('CREATE INDEX IDX_ECEA6D23D60322AC ON role_action (role_id)');
        $this->addSql('CREATE INDEX IDX_ECEA6D239D32F035 ON role_action (action_id)');
        $this->addSql('ALTER TABLE role_permiso ADD CONSTRAINT FK_41B70E65D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE NOT DEFERRABLE');
        $this->addSql('ALTER TABLE role_permiso ADD CONSTRAINT FK_41B70E656CEFAD37 FOREIGN KEY (permiso_id) REFERENCES permiso (id) ON DELETE CASCADE NOT DEFERRABLE');
        $this->addSql('ALTER TABLE role_action ADD CONSTRAINT FK_ECEA6D23D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE NOT DEFERRABLE');
        $this->addSql('ALTER TABLE role_action ADD CONSTRAINT FK_ECEA6D239D32F035 FOREIGN KEY (action_id) REFERENCES action (id) ON DELETE CASCADE NOT DEFERRABLE');
        $this->addSql('ALTER TABLE action_role DROP CONSTRAINT fk_21883164d60322ac');
        $this->addSql('ALTER TABLE action_role DROP CONSTRAINT fk_218831649d32f035');
        $this->addSql('ALTER TABLE permiso_role DROP CONSTRAINT fk_6648f72d60322ac');
        $this->addSql('ALTER TABLE permiso_role DROP CONSTRAINT fk_6648f726cefad37');
        $this->addSql('DROP TABLE action_role');
        $this->addSql('DROP TABLE permiso_role');
        $this->addSql('ALTER TABLE permiso_permiso DROP CONSTRAINT fk_ec89d1ffb41e1227');
        $this->addSql('ALTER TABLE permiso_permiso DROP CONSTRAINT fk_ec89d1ffadfb42a8');
        $this->addSql('DROP INDEX idx_ec89d1ffadfb42a8');
        $this->addSql('ALTER TABLE permiso_permiso DROP CONSTRAINT permiso_permiso_pkey');
        $this->addSql('DROP INDEX idx_ec89d1ffb41e1227');
        $this->addSql('ALTER TABLE permiso_permiso ADD permiso_id INT NOT NULL');
        $this->addSql('ALTER TABLE permiso_permiso DROP permiso_source');
        $this->addSql('ALTER TABLE permiso_permiso DROP permiso_target');
        $this->addSql('ALTER TABLE permiso_permiso ADD CONSTRAINT FK_EC89D1FF6CEFAD37 FOREIGN KEY (permiso_id) REFERENCES permiso (id) ON DELETE CASCADE NOT DEFERRABLE');
        $this->addSql('ALTER TABLE permiso_permiso ADD PRIMARY KEY (permiso_id)');
        $this->addSql('ALTER TABLE role_role DROP CONSTRAINT fk_e9d6f8fef4ac9ec2');
        $this->addSql('ALTER TABLE role_role DROP CONSTRAINT fk_e9d6f8feed49ce4d');
        $this->addSql('DROP INDEX idx_e9d6f8feed49ce4d');
        $this->addSql('DROP INDEX idx_e9d6f8fef4ac9ec2');
        $this->addSql('ALTER TABLE role_role DROP CONSTRAINT role_role_pkey');
        $this->addSql('ALTER TABLE role_role ADD role_id INT NOT NULL');
        $this->addSql('ALTER TABLE role_role DROP role_source');
        $this->addSql('ALTER TABLE role_role DROP role_target');
        $this->addSql('ALTER TABLE role_role ADD CONSTRAINT FK_E9D6F8FED60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE NOT DEFERRABLE');
        $this->addSql('ALTER TABLE role_role ADD PRIMARY KEY (role_id)');
        $this->addSql('ALTER TABLE taxon_taxon DROP CONSTRAINT fk_e2fd75254cd61b8d');
        $this->addSql('ALTER TABLE taxon_taxon DROP CONSTRAINT fk_e2fd752555334b02');
        $this->addSql('DROP INDEX idx_e2fd75254cd61b8d');
        $this->addSql('DROP INDEX idx_e2fd752555334b02');
        $this->addSql('ALTER TABLE taxon_taxon DROP CONSTRAINT taxon_taxon_pkey');
        $this->addSql('ALTER TABLE taxon_taxon ADD taxon_id INT NOT NULL');
        $this->addSql('ALTER TABLE taxon_taxon DROP taxon_source');
        $this->addSql('ALTER TABLE taxon_taxon DROP taxon_target');
        $this->addSql('ALTER TABLE taxon_taxon ADD CONSTRAINT FK_E2FD7525DE13F470 FOREIGN KEY (taxon_id) REFERENCES taxon (id) ON DELETE CASCADE NOT DEFERRABLE');
        $this->addSql('ALTER TABLE taxon_taxon ADD PRIMARY KEY (taxon_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE action_role (action_id INT NOT NULL, role_id INT NOT NULL, PRIMARY KEY (action_id, role_id))');
        $this->addSql('CREATE INDEX idx_218831649d32f035 ON action_role (action_id)');
        $this->addSql('CREATE INDEX idx_21883164d60322ac ON action_role (role_id)');
        $this->addSql('CREATE TABLE permiso_role (permiso_id INT NOT NULL, role_id INT NOT NULL, PRIMARY KEY (permiso_id, role_id))');
        $this->addSql('CREATE INDEX idx_6648f72d60322ac ON permiso_role (role_id)');
        $this->addSql('CREATE INDEX idx_6648f726cefad37 ON permiso_role (permiso_id)');
        $this->addSql('ALTER TABLE action_role ADD CONSTRAINT fk_21883164d60322ac FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE action_role ADD CONSTRAINT fk_218831649d32f035 FOREIGN KEY (action_id) REFERENCES action (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE permiso_role ADD CONSTRAINT fk_6648f72d60322ac FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE permiso_role ADD CONSTRAINT fk_6648f726cefad37 FOREIGN KEY (permiso_id) REFERENCES permiso (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE role_permiso DROP CONSTRAINT FK_41B70E65D60322AC');
        $this->addSql('ALTER TABLE role_permiso DROP CONSTRAINT FK_41B70E656CEFAD37');
        $this->addSql('ALTER TABLE role_action DROP CONSTRAINT FK_ECEA6D23D60322AC');
        $this->addSql('ALTER TABLE role_action DROP CONSTRAINT FK_ECEA6D239D32F035');
        $this->addSql('DROP TABLE role_permiso');
        $this->addSql('DROP TABLE role_action');
        $this->addSql('ALTER TABLE permiso_permiso DROP CONSTRAINT FK_EC89D1FF6CEFAD37');
        $this->addSql('ALTER TABLE permiso_permiso DROP CONSTRAINT permiso_permiso_pkey');
        $this->addSql('ALTER TABLE permiso_permiso ADD permiso_target INT NOT NULL');
        $this->addSql('ALTER TABLE permiso_permiso RENAME COLUMN permiso_id TO permiso_source');
        $this->addSql('ALTER TABLE permiso_permiso ADD CONSTRAINT fk_ec89d1ffb41e1227 FOREIGN KEY (permiso_target) REFERENCES permiso (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE permiso_permiso ADD CONSTRAINT fk_ec89d1ffadfb42a8 FOREIGN KEY (permiso_source) REFERENCES permiso (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_ec89d1ffadfb42a8 ON permiso_permiso (permiso_source)');
        $this->addSql('CREATE INDEX idx_ec89d1ffb41e1227 ON permiso_permiso (permiso_target)');
        $this->addSql('ALTER TABLE permiso_permiso ADD PRIMARY KEY (permiso_source, permiso_target)');
        $this->addSql('ALTER TABLE role_role DROP CONSTRAINT FK_E9D6F8FED60322AC');
        $this->addSql('ALTER TABLE role_role DROP CONSTRAINT role_role_pkey');
        $this->addSql('ALTER TABLE role_role ADD role_target INT NOT NULL');
        $this->addSql('ALTER TABLE role_role RENAME COLUMN role_id TO role_source');
        $this->addSql('ALTER TABLE role_role ADD CONSTRAINT fk_e9d6f8fef4ac9ec2 FOREIGN KEY (role_source) REFERENCES role (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE role_role ADD CONSTRAINT fk_e9d6f8feed49ce4d FOREIGN KEY (role_target) REFERENCES role (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_e9d6f8feed49ce4d ON role_role (role_target)');
        $this->addSql('CREATE INDEX idx_e9d6f8fef4ac9ec2 ON role_role (role_source)');
        $this->addSql('ALTER TABLE role_role ADD PRIMARY KEY (role_source, role_target)');
        $this->addSql('ALTER TABLE taxon_taxon DROP CONSTRAINT FK_E2FD7525DE13F470');
        $this->addSql('ALTER TABLE taxon_taxon DROP CONSTRAINT taxon_taxon_pkey');
        $this->addSql('ALTER TABLE taxon_taxon ADD taxon_target INT NOT NULL');
        $this->addSql('ALTER TABLE taxon_taxon RENAME COLUMN taxon_id TO taxon_source');
        $this->addSql('ALTER TABLE taxon_taxon ADD CONSTRAINT fk_e2fd75254cd61b8d FOREIGN KEY (taxon_target) REFERENCES taxon (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE taxon_taxon ADD CONSTRAINT fk_e2fd752555334b02 FOREIGN KEY (taxon_source) REFERENCES taxon (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_e2fd75254cd61b8d ON taxon_taxon (taxon_target)');
        $this->addSql('CREATE INDEX idx_e2fd752555334b02 ON taxon_taxon (taxon_source)');
        $this->addSql('ALTER TABLE taxon_taxon ADD PRIMARY KEY (taxon_source, taxon_target)');
    }
}
