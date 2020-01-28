<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200128120622 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE3DA5256D');
        $this->addSql('DROP INDEX UNIQ_2FB3D0EE3DA5256D ON project');
        $this->addSql('ALTER TABLE project ADD images_id INT DEFAULT NULL, DROP image_id');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EED44F05E5 FOREIGN KEY (images_id) REFERENCES images (id)');
        $this->addSql('CREATE INDEX IDX_2FB3D0EED44F05E5 ON project (images_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE password_request_token password_request_token VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');


        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EED44F05E5');
        $this->addSql('DROP INDEX IDX_2FB3D0EED44F05E5 ON project');
        $this->addSql('ALTER TABLE project ADD image_id INT DEFAULT NULL, DROP images_id');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE3DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2FB3D0EE3DA5256D ON project (image_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE password_request_token password_request_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
