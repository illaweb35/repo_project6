<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190828100517 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__lesson AS SELECT id, title, slug, sub_title, day_lesson, start_hour, end_hour, duration, amount, address, post_code, city, created_at, updated_at FROM lesson');
        $this->addSql('DROP TABLE lesson');
        $this->addSql('CREATE TABLE lesson (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, dance_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, slug VARCHAR(255) NOT NULL COLLATE BINARY, sub_title VARCHAR(255) NOT NULL COLLATE BINARY, day_lesson VARCHAR(255) NOT NULL COLLATE BINARY, start_hour TIME NOT NULL, end_hour TIME NOT NULL, duration DOUBLE PRECISION NOT NULL, amount DOUBLE PRECISION NOT NULL, address VARCHAR(255) DEFAULT NULL COLLATE BINARY, post_code VARCHAR(60) DEFAULT NULL COLLATE BINARY, city VARCHAR(255) DEFAULT NULL COLLATE BINARY, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, CONSTRAINT FK_F87474F365D64EDD FOREIGN KEY (dance_id) REFERENCES dance (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO lesson (id, title, slug, sub_title, day_lesson, start_hour, end_hour, duration, amount, address, post_code, city, created_at, updated_at) SELECT id, title, slug, sub_title, day_lesson, start_hour, end_hour, duration, amount, address, post_code, city, created_at, updated_at FROM __temp__lesson');
        $this->addSql('DROP TABLE __temp__lesson');
        $this->addSql('CREATE INDEX IDX_F87474F365D64EDD ON lesson (dance_id)');
        $this->addSql('DROP INDEX IDX_23A0E6612469DE2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT id, category_id, title, slug, subtitle, content, image, created_at, updated_at FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, slug VARCHAR(255) NOT NULL COLLATE BINARY, subtitle VARCHAR(255) NOT NULL COLLATE BINARY, content CLOB DEFAULT NULL COLLATE BINARY, image VARCHAR(255) DEFAULT NULL COLLATE BINARY, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, CONSTRAINT FK_23A0E6612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO article (id, category_id, title, slug, subtitle, content, image, created_at, updated_at) SELECT id, category_id, title, slug, subtitle, content, image, created_at, updated_at FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
        $this->addSql('CREATE INDEX IDX_23A0E6612469DE2 ON article (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_23A0E6612469DE2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT id, category_id, title, slug, subtitle, content, image, created_at, updated_at FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, subtitle VARCHAR(255) NOT NULL, content CLOB DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO article (id, category_id, title, slug, subtitle, content, image, created_at, updated_at) SELECT id, category_id, title, slug, subtitle, content, image, created_at, updated_at FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
        $this->addSql('CREATE INDEX IDX_23A0E6612469DE2 ON article (category_id)');
        $this->addSql('DROP INDEX IDX_F87474F365D64EDD');
        $this->addSql('CREATE TEMPORARY TABLE __temp__lesson AS SELECT id, title, slug, sub_title, day_lesson, start_hour, end_hour, duration, amount, address, post_code, city, created_at, updated_at FROM lesson');
        $this->addSql('DROP TABLE lesson');
        $this->addSql('CREATE TABLE lesson (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, sub_title VARCHAR(255) NOT NULL, day_lesson VARCHAR(255) NOT NULL, start_hour TIME NOT NULL, end_hour TIME NOT NULL, duration DOUBLE PRECISION NOT NULL, amount DOUBLE PRECISION NOT NULL, address VARCHAR(255) DEFAULT NULL, post_code VARCHAR(60) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO lesson (id, title, slug, sub_title, day_lesson, start_hour, end_hour, duration, amount, address, post_code, city, created_at, updated_at) SELECT id, title, slug, sub_title, day_lesson, start_hour, end_hour, duration, amount, address, post_code, city, created_at, updated_at FROM __temp__lesson');
        $this->addSql('DROP TABLE __temp__lesson');
    }
}
