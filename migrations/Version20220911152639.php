<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220911152639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE facture_detaille (id INT AUTO_INCREMENT NOT NULL, num_of_id INT NOT NULL, prix_total DOUBLE PRECISION NOT NULL, chiffre_affaire DOUBLE PRECISION NOT NULL, pu_total DOUBLE PRECISION NOT NULL, produit_name VARCHAR(55) NOT NULL, UNIQUE INDEX UNIQ_3D6036001D8E120A (num_of_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE facture_detaille ADD CONSTRAINT FK_3D6036001D8E120A FOREIGN KEY (num_of_id) REFERENCES produit (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture_detaille DROP FOREIGN KEY FK_3D6036001D8E120A');
        $this->addSql('DROP TABLE facture_detaille');
    }
}
