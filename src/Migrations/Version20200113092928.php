<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200113092928 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aanmeld CHANGE voorkeur voorkeur VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE apps DROP FOREIGN KEY FK_101C7E5A1F82D8F8');
        $this->addSql('DROP INDEX IDX_101C7E5A1F82D8F8 ON apps');
        $this->addSql('ALTER TABLE apps ADD parent_id INT DEFAULT NULL, DROP parentid_id, CHANGE image_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE apps ADD CONSTRAINT FK_101C7E5A727ACA70 FOREIGN KEY (parent_id) REFERENCES apps (id)');
        $this->addSql('CREATE INDEX IDX_101C7E5A727ACA70 ON apps (parent_id)');
        $this->addSql('ALTER TABLE blog CHANGE image_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE card CHANGE bgimage_id bgimage_id INT DEFAULT NULL, CHANGE frimage_id frimage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie CHANGE naam naam VARCHAR(255) DEFAULT NULL, CHANGE categorie categorie VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE project CHANGE image_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aanmeld CHANGE voorkeur voorkeur VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE apps DROP FOREIGN KEY FK_101C7E5A727ACA70');
        $this->addSql('DROP INDEX IDX_101C7E5A727ACA70 ON apps');
        $this->addSql('ALTER TABLE apps ADD parentid_id INT DEFAULT NULL, DROP parent_id, CHANGE image_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE apps ADD CONSTRAINT FK_101C7E5A1F82D8F8 FOREIGN KEY (parentid_id) REFERENCES apps (id)');
        $this->addSql('CREATE UNIQUE INDEX IDX_101C7E5A1F82D8F8 ON apps (parentid_id)');
        $this->addSql('ALTER TABLE blog CHANGE image_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE card CHANGE bgimage_id bgimage_id INT DEFAULT NULL, CHANGE frimage_id frimage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie CHANGE naam naam VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE categorie categorie VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE project CHANGE image_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
