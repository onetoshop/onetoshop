<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191106152353 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3A08EA79');
        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3E6DA28AA');
        $this->addSql('DROP INDEX UNIQ_161498D3E6DA28AA ON card');
        $this->addSql('DROP INDEX UNIQ_161498D3A08EA79 ON card');
        $this->addSql('ALTER TABLE card DROP frond_image_id, DROP background_image_id, DROP title, DROP customer, DROP body, DROP link, DROP footer');
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F3610A08EA79');
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F3610E6DA28AA');
        $this->addSql('DROP INDEX UNIQ_8C9F3610E6DA28AA ON file');
        $this->addSql('DROP INDEX UNIQ_8C9F3610A08EA79 ON file');
        $this->addSql('ALTER TABLE file DROP frond_image_id, DROP background_image_id, DROP name, DROP filename');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE card ADD frond_image_id INT DEFAULT NULL, ADD background_image_id INT DEFAULT NULL, ADD title VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, ADD customer VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, ADD body VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, ADD link VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, ADD footer VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3A08EA79 FOREIGN KEY (frond_image_id) REFERENCES file (id)');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3E6DA28AA FOREIGN KEY (background_image_id) REFERENCES file (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_161498D3E6DA28AA ON card (background_image_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_161498D3A08EA79 ON card (frond_image_id)');
        $this->addSql('ALTER TABLE file ADD frond_image_id INT DEFAULT NULL, ADD background_image_id INT DEFAULT NULL, ADD name VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, ADD filename VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610A08EA79 FOREIGN KEY (frond_image_id) REFERENCES card (id)');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610E6DA28AA FOREIGN KEY (background_image_id) REFERENCES card (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8C9F3610E6DA28AA ON file (background_image_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8C9F3610A08EA79 ON file (frond_image_id)');
    }
}
