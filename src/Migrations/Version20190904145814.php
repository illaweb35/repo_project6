<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190904145814 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, image_caption VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE TABLE lesson (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, dance_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, sub_title VARCHAR(255) NOT NULL, day_lesson VARCHAR(255) NOT NULL, start_hour TIME NOT NULL, end_hour TIME NOT NULL, duration DOUBLE PRECISION NOT NULL, amount DOUBLE PRECISION NOT NULL, address VARCHAR(255) DEFAULT NULL, post_code VARCHAR(60) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, image_caption VARCHAR(255) DEFAULT NULL, lon DOUBLE PRECISION DEFAULT NULL, lat DOUBLE PRECISION NOT NULL)');
        $this->addSql('CREATE INDEX IDX_F87474F365D64EDD ON lesson (dance_id)');
        $this->addSql('CREATE TABLE member (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lesson_id INTEGER NOT NULL, user_first_name VARCHAR(255) NOT NULL, user_last_name VARCHAR(255) NOT NULL, birthday DATETIME NOT NULL, image VARCHAR(255) DEFAULT NULL, civility VARCHAR(60) DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone_number VARCHAR(60) DEFAULT NULL, mobile_number VARCHAR(60) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, post_code VARCHAR(60) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, infos CLOB DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, image_caption VARCHAR(255) DEFAULT NULL, older INTEGER NOT NULL, slug VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_70E4FA78CDF80196 ON member (lesson_id)');
        $this->addSql('CREATE TABLE professor (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(60) DEFAULT NULL, mobile_number VARCHAR(60) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, post_code VARCHAR(60) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, image_caption VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, sub_title VARCHAR(255) NOT NULL, content CLOB DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, image_caption VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_23A0E6612469DE2 ON article (category_id)');
        $this->addSql('CREATE TABLE category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, color_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL)');
        $this->addSql('CREATE TABLE dance (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, professor_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, sub_title VARCHAR(255) NOT NULL, content CLOB NOT NULL, image VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, image_caption VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_184BFD6F7D2D84D5 ON dance (professor_id)');
        $this->addSql('CREATE TABLE prospect (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone_number VARCHAR(60) DEFAULT NULL, subject VARCHAR(255) NOT NULL, content CLOB NOT NULL, agree_rgpd BOOLEAN NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE lesson');
        $this->addSql('DROP TABLE member');
        $this->addSql('DROP TABLE professor');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE dance');
        $this->addSql('DROP TABLE prospect');
    }
}
