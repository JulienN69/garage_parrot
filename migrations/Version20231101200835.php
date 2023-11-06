<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231101200835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, last_name VARCHAR(40) NOT NULL, first_name VARCHAR(40) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, mileage INT NOT NULL, date_creation DATETIME NOT NULL, price DOUBLE PRECISION NOT NULL, modele VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipment (id INT AUTO_INCREMENT NOT NULL, equipment_title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE services (id INT AUTO_INCREMENT NOT NULL, service_title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE car_equipment (car_id INT NOT NULL, equipment_id INT NOT NULL, INDEX IDX_D4DA27AFC3C6F69F (car_id), INDEX IDX_D4DA27AF517FE9FE (equipment_id), PRIMARY KEY(car_id, equipment_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');

        $this->addSql('ALTER TABLE car_equipment ADD CONSTRAINT FK_D4DA27AFC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE car_equipment ADD CONSTRAINT FK_D4DA27AF517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipment ADD car_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D583C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('CREATE INDEX IDX_D338D583C3C6F69F ON equipment (car_id)');

        $this->addSql('ALTER TABLE car ADD image_name VARCHAR(255) DEFAULT NULL, ADD image_size INT DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE services ADD image_name VARCHAR(255) DEFAULT NULL, ADD image_size INT DEFAULT NULL, CHANGE description description TEXT NOT NULL');
        $this->addSql('ALTER TABLE car ADD image_name VARCHAR(255) DEFAULT NULL, ADD image_size INT DEFAULT NULL');
        $this->addSql('ALTER TABLE car_pictures ADD updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP picture_file');
        $this->addSql('ALTER TABLE car ADD updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, message_title VARCHAR(255) NOT NULL, message_content LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car ADD energy VARCHAR(50) DEFAULT NULL, ADD gearbox VARCHAR(50) DEFAULT NULL, ADD color VARCHAR(50) DEFAULT NULL, ADD power INT DEFAULT NULL, ADD thumnail_critair INT DEFAULT NULL, ADD gates_number INT DEFAULT NULL, ADD length DOUBLE PRECISION DEFAULT NULL, ADD origin VARCHAR(50) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE car');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE services');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('DROP TABLE car_equipment');

        $this->addSql('ALTER TABLE car_equipment DROP FOREIGN KEY FK_D4DA27AFC3C6F69F');
        $this->addSql('ALTER TABLE car_equipment DROP FOREIGN KEY FK_D4DA27AF517FE9FE');
        $this->addSql('ALTER TABLE equipment DROP car_id');
        $this->addSql('ALTER TABLE equipment DROP FOREIGN KEY FK_D338D583C3C6F69F');
        $this->addSql('DROP INDEX IDX_D338D583C3C6F69F ON equipment');

        $this->addSql('ALTER TABLE car DROP image_name, DROP image_size, DROP updated_at');
        $this->addSql('ALTER TABLE services DROP image_name, DROP image_size, CHANGE description description TEXT NOT NULL');
        $this->addSql('ALTER TABLE car DROP image_name, DROP image_size');
        $this->addSql('ALTER TABLE car_pictures ADD picture_file VARCHAR(255) NOT NULL, DROP updated_at');
        $this->addSql('ALTER TABLE car DROP updated_at');
        $this->addSql('DROP TABLE contact');
        $this->addSql('ALTER TABLE car DROP energy, DROP gearbox, DROP color, DROP power, DROP thumnail_critair, DROP gates_number, DROP length, DROP origin');
    }
}
