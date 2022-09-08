<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220908215901 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit ADD produit_name_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27B7EC17AF FOREIGN KEY (produit_name_id) REFERENCES produit_name (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27B7EC17AF ON produit (produit_name_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27B7EC17AF');
        $this->addSql('DROP INDEX IDX_29A5EC27B7EC17AF ON produit');
        $this->addSql('ALTER TABLE produit DROP produit_name_id');
    }
}
