<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260216174250 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Trip DROP INDEX UNIQ_D6645A05D81022C0, ADD INDEX IDX_D6645A05D81022C0 (preference_id)');
        $this->addSql('ALTER TABLE Trip DROP FOREIGN KEY FK_D6645A05545317D1');
        $this->addSql('DROP INDEX IDX_D6645A05545317D1 ON Trip');
        $this->addSql('ALTER TABLE Trip ADD departureAddress VARCHAR(50) NOT NULL, ADD departureCity VARCHAR(50) NOT NULL, ADD arrivalAddress VARCHAR(50) NOT NULL, ADD arrivalCity VARCHAR(50) NOT NULL, ADD seatPrice INT NOT NULL, ADD status VARCHAR(20) NOT NULL, ADD createdAt DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updatedAt DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP vehicle_id, DROP numberSeats, CHANGE departureDay departureDay DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE arrivalDay arrivalDay DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Trip DROP INDEX IDX_D6645A05D81022C0, ADD UNIQUE INDEX UNIQ_D6645A05D81022C0 (preference_id)');
        $this->addSql('ALTER TABLE Trip ADD numberSeats INT NOT NULL, DROP departureAddress, DROP departureCity, DROP arrivalAddress, DROP arrivalCity, DROP status, DROP createdAt, DROP updatedAt, CHANGE departureDay departureDay DATETIME NOT NULL, CHANGE arrivalDay arrivalDay DATETIME NOT NULL, CHANGE seatPrice vehicle_id INT NOT NULL');
        $this->addSql('ALTER TABLE Trip ADD CONSTRAINT FK_D6645A05545317D1 FOREIGN KEY (vehicle_id) REFERENCES Vehicle (id)');
        $this->addSql('CREATE INDEX IDX_D6645A05545317D1 ON Trip (vehicle_id)');
    }
}
