<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191104113458 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE card (id INT AUTO_INCREMENT NOT NULL, title TINYTEXT NOT NULL, background_img TINYTEXT NOT NULL, frond_img TINYTEXT NOT NULL, customer TINYTEXT NOT NULL, body LONGTEXT NOT NULL, link LONGTEXT NOT NULL, footer LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gegeven (id INT AUTO_INCREMENT NOT NULL, title TINYTEXT NOT NULL, slug VARCHAR(128) NOT NULL, body LONGTEXT NOT NULL, `group` TINYTEXT NOT NULL, UNIQUE INDEX UNIQ_4E5258CF989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hoofd (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(128) NOT NULL, title TINYTEXT NOT NULL, body LONGTEXT NOT NULL, header1 LONGTEXT NOT NULL, body1 LONGTEXT NOT NULL, header2 LONGTEXT NOT NULL, body2 LONGTEXT NOT NULL, header3 LONGTEXT NOT NULL, body3 LONGTEXT NOT NULL, header4 LONGTEXT NOT NULL, body4 LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_36D6C9B9989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE card');
        $this->addSql('DROP TABLE gegeven');
        $this->addSql('DROP TABLE hoofd');
    }
}
