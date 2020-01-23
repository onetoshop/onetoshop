<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200122144325 extends AbstractMigration
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
        $this->addSql('ALTER TABLE apps CHANGE image_id image_id INT DEFAULT NULL, CHANGE parent_id parent_id INT DEFAULT NULL, CHANGE naam naam VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE blog CHANGE image_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE card CHANGE bgimage_id bgimage_id INT DEFAULT NULL, CHANGE frimage_id frimage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie CHANGE naam naam VARCHAR(255) DEFAULT NULL, CHANGE categorie categorie VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CD44F05E5 FOREIGN KEY (images_id) REFERENCES images (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10CD44F05E5 ON media (images_id)');
        $this->addSql('ALTER TABLE project CHANGE image_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE password_request_token password_request_token VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aanmeld CHANGE voorkeur voorkeur VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE apps CHANGE image_id image_id INT DEFAULT NULL, CHANGE parent_id parent_id INT DEFAULT NULL, CHANGE naam naam VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE blog CHANGE image_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE card CHANGE bgimage_id bgimage_id INT DEFAULT NULL, CHANGE frimage_id frimage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie CHANGE naam naam VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE categorie categorie VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CD44F05E5');
        $this->addSql('DROP INDEX IDX_6A2CA10CD44F05E5 ON media');
        $this->addSql('ALTER TABLE project CHANGE image_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE password_request_token password_request_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
