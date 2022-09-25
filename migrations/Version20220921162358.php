<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220921162358 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prod_fact ADD societeee_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prod_fact ADD CONSTRAINT FK_E2E7EC453D025839 FOREIGN KEY (societeee_id) REFERENCES societe (id)');
        $this->addSql('CREATE INDEX IDX_E2E7EC453D025839 ON prod_fact (societeee_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prod_fact DROP FOREIGN KEY FK_E2E7EC453D025839');
        $this->addSql('DROP INDEX IDX_E2E7EC453D025839 ON prod_fact');
        $this->addSql('ALTER TABLE prod_fact DROP societeee_id');
    }
}
