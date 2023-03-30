<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230330161547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE film (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, director VARCHAR(255) DEFAULT NULL, year INTEGER NOT NULL, rating INTEGER NOT NULL)');
        $this->addSql('DROP TABLE shopping_list');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE shopping_list (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, product VARCHAR(255) NOT NULL COLLATE "BINARY", amount INTEGER NOT NULL, version VARCHAR(255) DEFAULT NULL COLLATE "BINARY")');
        $this->addSql('DROP TABLE film');
    }
}
