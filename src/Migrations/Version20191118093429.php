<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191118093429 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE aanmeld (id INT AUTO_INCREMENT NOT NULL, voornaam LONGTEXT NOT NULL, achternaam VARCHAR(255) NOT NULL, telefoon VARCHAR(255) NOT NULL, doel VARCHAR(255) NOT NULL, contact VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, voorkeur VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE card (id INT AUTO_INCREMENT NOT NULL, title LONGTEXT DEFAULT NULL, customer LONGTEXT DEFAULT NULL, body LONGTEXT DEFAULT NULL, link LONGTEXT DEFAULT NULL, footer LONGTEXT DEFAULT NULL, backgroundimage LONGTEXT NOT NULL, frondimage LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, naam VARCHAR(255) DEFAULT NULL, categorie VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE created_at (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gegeven (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, body VARCHAR(500) NOT NULL, groep VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hoofd (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(128) NOT NULL, title TINYTEXT NOT NULL, body LONGTEXT NOT NULL, header1 LONGTEXT NOT NULL, body1 LONGTEXT NOT NULL, header2 LONGTEXT NOT NULL, body2 LONGTEXT NOT NULL, header3 LONGTEXT NOT NULL, body3 LONGTEXT NOT NULL, header4 LONGTEXT NOT NULL, body4 LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_36D6C9B9989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, image LONGTEXT NOT NULL, image1 LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE testenah (id INT AUTO_INCREMENT NOT NULL, bakfiets VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE aanmeld');
        $this->addSql('DROP TABLE card');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE created_at');
        $this->addSql('DROP TABLE gegeven');
        $this->addSql('DROP TABLE hoofd');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE testenah');
        $this->addSql('DROP TABLE user');
    }
}
