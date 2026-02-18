<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260217142741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Trip DROP INDEX IDX_D6645A05D81022C0, ADD UNIQUE INDEX UNIQ_D6645A05D81022C0 (preference_id)');
        $this->addSql('ALTER TABLE Trip ADD numberSeats INT NOT NULL, CHANGE departureDay departureDay DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE arrivalDay arrivalDay DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE Vehicle CHANGE seats numberSeats INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Trip DROP INDEX UNIQ_D6645A05D81022C0, ADD INDEX IDX_D6645A05D81022C0 (preference_id)');
        $this->addSql('ALTER TABLE Trip DROP numberSeats, CHANGE departureDay departureDay DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE arrivalDay arrivalDay DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE Vehicle CHANGE numberSeats seats INT NOT NULL');
    }
}
