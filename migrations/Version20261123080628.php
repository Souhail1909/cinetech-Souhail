<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261123080628 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__movie AS SELECT id, title, synopsis, duration, release_date, press_rating, poster FROM movie');
        $this->addSql('DROP TABLE movie');
        $this->addSql('CREATE TABLE movie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, synopsis CLOB DEFAULT NULL, duration INTEGER NOT NULL, release_date DATE NOT NULL, press_rating DOUBLE PRECISION DEFAULT NULL, poster VARCHAR(255) DEFAULT NULL, category_id INTEGER NOT NULL, CONSTRAINT FK_1D5EF26F12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO movie (id, title, synopsis, duration, release_date, press_rating, poster) SELECT id, title, synopsis, duration, release_date, press_rating, poster FROM __temp__movie');
        $this->addSql('DROP TABLE __temp__movie');
        $this->addSql('CREATE INDEX IDX_1D5EF26F12469DE2 ON movie (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE category');
        $this->addSql('CREATE TEMPORARY TABLE __temp__movie AS SELECT id, title, synopsis, duration, release_date, press_rating, poster FROM movie');
        $this->addSql('DROP TABLE movie');
        $this->addSql('CREATE TABLE movie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, synopsis CLOB DEFAULT NULL, duration INTEGER NOT NULL, release_date DATE NOT NULL, press_rating DOUBLE PRECISION DEFAULT NULL, poster VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO movie (id, title, synopsis, duration, release_date, press_rating, poster) SELECT id, title, synopsis, duration, release_date, press_rating, poster FROM __temp__movie');
        $this->addSql('DROP TABLE __temp__movie');
    }
}
