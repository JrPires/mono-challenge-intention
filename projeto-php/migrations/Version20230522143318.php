<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230522143318 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rating DROP CONSTRAINT fk_d8892622e252916b');
        $this->addSql('DROP INDEX idx_d8892622e252916b');
        $this->addSql('ALTER TABLE rating RENAME COLUMN rating_id_id TO product_id');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D88926224584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D88926224584665A ON rating (product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE rating DROP CONSTRAINT FK_D88926224584665A');
        $this->addSql('DROP INDEX IDX_D88926224584665A');
        $this->addSql('ALTER TABLE rating RENAME COLUMN product_id TO rating_id_id');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT fk_d8892622e252916b FOREIGN KEY (rating_id_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_d8892622e252916b ON rating (rating_id_id)');
    }
}
