<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260209160448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Booking (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, trip_id INT NOT NULL, seatNumber INT NOT NULL, INDEX IDX_2FB1D442A76ED395 (user_id), INDEX IDX_2FB1D442A5BC2E0E (trip_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Notice (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, target_id INT NOT NULL, booking_id INT NOT NULL, mark INT NOT NULL, comment LONGTEXT NOT NULL, isComplaint TINYINT(1) NOT NULL, INDEX IDX_4FA140F4F675F31B (author_id), INDEX IDX_4FA140F4158E0B66 (target_id), UNIQUE INDEX UNIQ_4FA140F43301C60 (booking_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Preference (id INT AUTO_INCREMENT NOT NULL, airConditioning TINYINT(1) NOT NULL, animalsAccepted TINYINT(1) NOT NULL, smokeVap TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Trip (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, vehicle_id INT NOT NULL, preference_id INT NOT NULL, departureDay DATETIME NOT NULL, arrivalDay DATETIME NOT NULL, numberSeats INT NOT NULL, seatAvailable INT NOT NULL, INDEX IDX_D6645A05A76ED395 (user_id), INDEX IDX_D6645A05545317D1 (vehicle_id), UNIQUE INDEX UNIQ_D6645A05D81022C0 (preference_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE User (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', firstname VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, phone VARCHAR(10) NOT NULL, credits INT NOT NULL, isPassenger TINYINT(1) NOT NULL, isDriver TINYINT(1) NOT NULL, createdAt DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_2DA17977E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Vehicle (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, brand VARCHAR(50) NOT NULL, model VARCHAR(50) NOT NULL, seats INT NOT NULL, INDEX IDX_D43DDD1A7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Booking ADD CONSTRAINT FK_2FB1D442A76ED395 FOREIGN KEY (user_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE Booking ADD CONSTRAINT FK_2FB1D442A5BC2E0E FOREIGN KEY (trip_id) REFERENCES Trip (id)');
        $this->addSql('ALTER TABLE Notice ADD CONSTRAINT FK_4FA140F4F675F31B FOREIGN KEY (author_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE Notice ADD CONSTRAINT FK_4FA140F4158E0B66 FOREIGN KEY (target_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE Notice ADD CONSTRAINT FK_4FA140F43301C60 FOREIGN KEY (booking_id) REFERENCES Booking (id)');
        $this->addSql('ALTER TABLE Trip ADD CONSTRAINT FK_D6645A05A76ED395 FOREIGN KEY (user_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE Trip ADD CONSTRAINT FK_D6645A05545317D1 FOREIGN KEY (vehicle_id) REFERENCES Vehicle (id)');
        $this->addSql('ALTER TABLE Trip ADD CONSTRAINT FK_D6645A05D81022C0 FOREIGN KEY (preference_id) REFERENCES Preference (id)');
        $this->addSql('ALTER TABLE Vehicle ADD CONSTRAINT FK_D43DDD1A7E3C61F9 FOREIGN KEY (owner_id) REFERENCES User (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Booking DROP FOREIGN KEY FK_2FB1D442A76ED395');
        $this->addSql('ALTER TABLE Booking DROP FOREIGN KEY FK_2FB1D442A5BC2E0E');
        $this->addSql('ALTER TABLE Notice DROP FOREIGN KEY FK_4FA140F4F675F31B');
        $this->addSql('ALTER TABLE Notice DROP FOREIGN KEY FK_4FA140F4158E0B66');
        $this->addSql('ALTER TABLE Notice DROP FOREIGN KEY FK_4FA140F43301C60');
        $this->addSql('ALTER TABLE Trip DROP FOREIGN KEY FK_D6645A05A76ED395');
        $this->addSql('ALTER TABLE Trip DROP FOREIGN KEY FK_D6645A05545317D1');
        $this->addSql('ALTER TABLE Trip DROP FOREIGN KEY FK_D6645A05D81022C0');
        $this->addSql('ALTER TABLE Vehicle DROP FOREIGN KEY FK_D43DDD1A7E3C61F9');
        $this->addSql('DROP TABLE Booking');
        $this->addSql('DROP TABLE Notice');
        $this->addSql('DROP TABLE Preference');
        $this->addSql('DROP TABLE Trip');
        $this->addSql('DROP TABLE User');
        $this->addSql('DROP TABLE Vehicle');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
