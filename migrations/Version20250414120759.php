<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250414120759 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post (id SERIAL NOT NULL, id_app_user_id INT NOT NULL, body VARCHAR(255) DEFAULT NULL, media_data BYTEA NOT NULL, media_type VARCHAR(255) NOT NULL, date_created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5A8A6C8D52219E2F ON post (id_app_user_id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D52219E2F FOREIGN KEY (id_app_user_id) REFERENCES app_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE post DROP CONSTRAINT FK_5A8A6C8D52219E2F');
        $this->addSql('DROP TABLE post');
    }
}
