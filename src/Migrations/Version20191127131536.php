<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191127131536 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aanmeld ADD created_at DATETIME NOT NULL, CHANGE voorkeur voorkeur VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE apps CHANGE image_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE blog DROP FOREIGN KEY FK_C01551433DA5256D');
        $this->addSql('DROP INDEX UNIQ_C01551433DA5256D ON blog');
        $this->addSql('ALTER TABLE blog ADD image LONGTEXT NOT NULL, DROP image_id');
        $this->addSql('ALTER TABLE card CHANGE bgimage_id bgimage_id INT DEFAULT NULL, CHANGE frimage_id frimage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie CHANGE naam naam VARCHAR(255) DEFAULT NULL, CHANGE categorie categorie VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aanmeld DROP created_at, CHANGE voorkeur voorkeur VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE apps CHANGE image_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE blog ADD image_id INT DEFAULT NULL, DROP image');
        $this->addSql('ALTER TABLE blog ADD CONSTRAINT FK_C01551433DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C01551433DA5256D ON blog (image_id)');
        $this->addSql('ALTER TABLE card CHANGE bgimage_id bgimage_id INT DEFAULT NULL, CHANGE frimage_id frimage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie CHANGE naam naam VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE categorie categorie VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
