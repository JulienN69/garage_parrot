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
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car ADD energy VARCHAR(50) DEFAULT NULL, ADD gearbox VARCHAR(50) DEFAULT NULL, ADD color VARCHAR(50) DEFAULT NULL, ADD power INT DEFAULT NULL, ADD thumnail_critair INT DEFAULT NULL, ADD gates_number INT DEFAULT NULL, ADD length DOUBLE PRECISION DEFAULT NULL, ADD origin VARCHAR(50) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car DROP energy, DROP gearbox, DROP color, DROP power, DROP thumnail_critair, DROP gates_number, DROP length, DROP origin');
    }
}
