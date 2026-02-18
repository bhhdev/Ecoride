<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260216175944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Trip ADD vehicle_id INT NOT NULL');
        $this->addSql('ALTER TABLE Trip ADD CONSTRAINT FK_D6645A05545317D1 FOREIGN KEY (vehicle_id) REFERENCES Vehicle (id)');
        $this->addSql('CREATE INDEX IDX_D6645A05545317D1 ON Trip (vehicle_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Trip DROP FOREIGN KEY FK_D6645A05545317D1');
        $this->addSql('DROP INDEX IDX_D6645A05545317D1 ON Trip');
        $this->addSql('ALTER TABLE Trip DROP vehicle_id');
    }
}
