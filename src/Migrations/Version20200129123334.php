<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200129123334 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE functionaliteit (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(100) DEFAULT NULL, body LONGTEXT DEFAULT NULL, tabtitle LONGTEXT DEFAULT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_D8731378989D9B62 (slug), INDEX IDX_D8731378727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE functionaliteit ADD CONSTRAINT FK_D8731378727ACA70 FOREIGN KEY (parent_id) REFERENCES functionaliteit (id)');
        $this->addSql('ALTER TABLE aanmeld CHANGE voorkeur voorkeur VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE apps CHANGE parent_id parent_id INT DEFAULT NULL, CHANGE images_id images_id INT DEFAULT NULL, CHANGE naam naam VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE blog CHANGE images_id images_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE card CHANGE images_id images_id INT DEFAULT NULL, CHANGE images1_id images1_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie CHANGE naam naam VARCHAR(255) DEFAULT NULL, CHANGE categorie categorie VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE project CHANGE images_id images_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE password_request_token password_request_token VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE functionaliteit DROP FOREIGN KEY FK_D8731378727ACA70');
        $this->addSql('DROP TABLE functionaliteit');
        $this->addSql('ALTER TABLE aanmeld CHANGE voorkeur voorkeur VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE apps CHANGE images_id images_id INT DEFAULT NULL, CHANGE parent_id parent_id INT DEFAULT NULL, CHANGE naam naam VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE blog CHANGE images_id images_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE card CHANGE images_id images_id INT DEFAULT NULL, CHANGE images1_id images1_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie CHANGE naam naam VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE categorie categorie VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE project CHANGE images_id images_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE password_request_token password_request_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
