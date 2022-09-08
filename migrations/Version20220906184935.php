<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220906184935 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE colisage (id INT AUTO_INCREMENT NOT NULL, num_of_id INT NOT NULL, reference VARCHAR(55) NOT NULL, quantite INT NOT NULL, remarque VARCHAR(255) DEFAULT NULL, colisage VARCHAR(55) DEFAULT NULL, num_coli VARCHAR(55) DEFAULT NULL, UNIQUE INDEX UNIQ_8A5758F21D8E120A (num_of_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, ref_complete VARCHAR(55) NOT NULL, num_cs VARCHAR(55) DEFAULT NULL, ref_principale VARCHAR(55) NOT NULL, designation VARCHAR(55) DEFAULT NULL, quantite INT NOT NULL, qte_expedie INT DEFAULT NULL, temps_gamme DOUBLE PRECISION DEFAULT NULL, date_prevu DATE DEFAULT NULL, temps_facture DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE colisage ADD CONSTRAINT FK_8A5758F21D8E120A FOREIGN KEY (num_of_id) REFERENCES produit (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE colisage DROP FOREIGN KEY FK_8A5758F21D8E120A');
        $this->addSql('DROP TABLE colisage');
        $this->addSql('DROP TABLE produit');
    }
}
