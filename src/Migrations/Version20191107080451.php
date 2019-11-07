<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191107080451 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE card ADD title LONGTEXT DEFAULT NULL, ADD customer LONGTEXT DEFAULT NULL, ADD body LONGTEXT DEFAULT NULL, ADD link LONGTEXT DEFAULT NULL, ADD footer LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE file ADD image_id INT DEFAULT NULL, ADD card_id INT DEFAULT NULL, ADD name VARCHAR(255) DEFAULT NULL, ADD filename VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F36103DA5256D FOREIGN KEY (image_id) REFERENCES card (id)');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F36104ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id)');
        $this->addSql('CREATE INDEX IDX_8C9F36103DA5256D ON file (image_id)');
        $this->addSql('CREATE INDEX IDX_8C9F36104ACC9A20 ON file (card_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE card DROP title, DROP customer, DROP body, DROP link, DROP footer');
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F36103DA5256D');
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F36104ACC9A20');
        $this->addSql('DROP INDEX IDX_8C9F36103DA5256D ON file');
        $this->addSql('DROP INDEX IDX_8C9F36104ACC9A20 ON file');
        $this->addSql('ALTER TABLE file DROP image_id, DROP card_id, DROP name, DROP filename');
    }
}
