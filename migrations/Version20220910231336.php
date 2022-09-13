<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220910231336 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE colisage (id INT AUTO_INCREMENT NOT NULL, num_of_id INT NOT NULL, reference VARCHAR(55) NOT NULL, quantite INT NOT NULL, remarque VARCHAR(255) DEFAULT NULL, colisage VARCHAR(55) DEFAULT NULL, num_coli VARCHAR(55) DEFAULT NULL, UNIQUE INDEX UNIQ_8A5758F21D8E120A (num_of_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, datefact DATE NOT NULL, typefac VARCHAR(255) DEFAULT NULL, adress_liv VARCHAR(255) DEFAULT NULL, adress_fab VARCHAR(255) DEFAULT NULL, net_payer DOUBLE PRECISION NOT NULL, nbr_palette DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, produit_name_id INT DEFAULT NULL, ref_complete VARCHAR(55) NOT NULL, num_cs VARCHAR(55) DEFAULT NULL, ref_principale VARCHAR(55) NOT NULL, designation VARCHAR(55) DEFAULT NULL, quantite INT NOT NULL, qte_expedie INT DEFAULT NULL, temps_gamme DOUBLE PRECISION DEFAULT NULL, date_prevu DATE DEFAULT NULL, temps_facture DOUBLE PRECISION DEFAULT NULL, pu DOUBLE PRECISION NOT NULL, INDEX IDX_29A5EC27B7EC17AF (produit_name_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_name (id INT AUTO_INCREMENT NOT NULL, produit_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE societe (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(55) NOT NULL, adress VARCHAR(255) DEFAULT NULL, num_telephon INT DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, username VARCHAR(55) NOT NULL, lastname VARCHAR(55) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE colisage ADD CONSTRAINT FK_8A5758F21D8E120A FOREIGN KEY (num_of_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27B7EC17AF FOREIGN KEY (produit_name_id) REFERENCES produit_name (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE colisage DROP FOREIGN KEY FK_8A5758F21D8E120A');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27B7EC17AF');
        $this->addSql('DROP TABLE colisage');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_name');
        $this->addSql('DROP TABLE societe');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
