<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191107082601 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE file (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, card_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, filename VARCHAR(255) DEFAULT NULL, INDEX IDX_8C9F36103DA5256D (image_id), INDEX IDX_8C9F36104ACC9A20 (card_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F36103DA5256D FOREIGN KEY (image_id) REFERENCES card (id)');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F36104ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id)');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE image');
        $this->addSql('ALTER TABLE card CHANGE title title LONGTEXT DEFAULT NULL, CHANGE customer customer LONGTEXT DEFAULT NULL, CHANGE body body LONGTEXT DEFAULT NULL, CHANGE link link LONGTEXT DEFAULT NULL, CHANGE footer footer LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, naam VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, categorie VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, card_id INT DEFAULT NULL, bg_img LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, fr_img LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_C53D045F4ACC9A20 (card_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F4ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id)');
        $this->addSql('DROP TABLE file');
        $this->addSql('ALTER TABLE card CHANGE title title TINYTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE customer customer TINYTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE body body LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE link link LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE footer footer LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
