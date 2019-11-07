<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191106152019 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE file (id INT AUTO_INCREMENT NOT NULL, frond_image_id INT DEFAULT NULL, background_image_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, filename VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8C9F3610A08EA79 (frond_image_id), UNIQUE INDEX UNIQ_8C9F3610E6DA28AA (background_image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610A08EA79 FOREIGN KEY (frond_image_id) REFERENCES card (id)');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610E6DA28AA FOREIGN KEY (background_image_id) REFERENCES card (id)');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('ALTER TABLE card ADD frond_image_id INT DEFAULT NULL, ADD background_image_id INT DEFAULT NULL, ADD title VARCHAR(255) DEFAULT NULL, ADD customer VARCHAR(255) DEFAULT NULL, ADD body VARCHAR(255) DEFAULT NULL, ADD link VARCHAR(255) DEFAULT NULL, ADD footer VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3A08EA79 FOREIGN KEY (frond_image_id) REFERENCES file (id)');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3E6DA28AA FOREIGN KEY (background_image_id) REFERENCES file (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_161498D3A08EA79 ON card (frond_image_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_161498D3E6DA28AA ON card (background_image_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3A08EA79');
        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3E6DA28AA');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, naam VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, categorie VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP INDEX UNIQ_161498D3A08EA79 ON card');
        $this->addSql('DROP INDEX UNIQ_161498D3E6DA28AA ON card');
        $this->addSql('ALTER TABLE card DROP frond_image_id, DROP background_image_id, DROP title, DROP customer, DROP body, DROP link, DROP footer');
    }
}
