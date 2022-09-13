<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220910232603 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prod_fact (id INT AUTO_INCREMENT NOT NULL, prod_id_id INT DEFAULT NULL, fact_id_id INT DEFAULT NULL, date_prevu DATE DEFAULT NULL, quantity INT NOT NULL, facture_export VARCHAR(255) DEFAULT NULL, declar_douane VARCHAR(255) DEFAULT NULL, INDEX IDX_E2E7EC45F91A0F34 (prod_id_id), INDEX IDX_E2E7EC45769609AE (fact_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prod_fact ADD CONSTRAINT FK_E2E7EC45F91A0F34 FOREIGN KEY (prod_id_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE prod_fact ADD CONSTRAINT FK_E2E7EC45769609AE FOREIGN KEY (fact_id_id) REFERENCES facture (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prod_fact DROP FOREIGN KEY FK_E2E7EC45F91A0F34');
        $this->addSql('ALTER TABLE prod_fact DROP FOREIGN KEY FK_E2E7EC45769609AE');
        $this->addSql('DROP TABLE prod_fact');
    }
}
