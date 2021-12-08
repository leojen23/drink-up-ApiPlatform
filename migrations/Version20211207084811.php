<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211207084811 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gardener_plant ADD last_watering_date DATETIME DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL, CHANGE plant_id plant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE watering DROP FOREIGN KEY FK_818F9D3135F46CF6');
        $this->addSql('ALTER TABLE watering ADD CONSTRAINT FK_818F9D3135F46CF6 FOREIGN KEY (gardenerplant_id) REFERENCES gardener_plant (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gardener_plant DROP last_watering_date, CHANGE user_id user_id INT NOT NULL, CHANGE plant_id plant_id INT NOT NULL');
        $this->addSql('ALTER TABLE watering DROP FOREIGN KEY FK_818F9D3135F46CF6');
        $this->addSql('ALTER TABLE watering ADD CONSTRAINT FK_818F9D3135F46CF6 FOREIGN KEY (gardenerplant_id) REFERENCES gardener_plant (id) ON DELETE CASCADE');
    }
}
