<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211018162806 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gardener_plant (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, plant_id INT NOT NULL, nickname VARCHAR(100) NOT NULL, sunlight VARCHAR(100) NOT NULL, size VARCHAR(100) NOT NULL, season VARCHAR(100) NOT NULL, topography VARCHAR(100) NOT NULL, location VARCHAR(100) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_13D81FB6A76ED395 (user_id), INDEX IDX_13D81FB61D935652 (plant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plant (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, image VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, exposition LONGTEXT NOT NULL, care LONGTEXT NOT NULL, toxicity LONGTEXT NOT NULL, frequency INT NOT NULL, type VARCHAR(50) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, gender VARCHAR(50) NOT NULL, firstname VARCHAR(100) NOT NULL, surname VARCHAR(100) NOT NULL, is_notified TINYINT(1) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE watering (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, gardenerplant_id INT NOT NULL, lateness INT NOT NULL, watered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_818F9D31A76ED395 (user_id), INDEX IDX_818F9D3135F46CF6 (gardenerplant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gardener_plant ADD CONSTRAINT FK_13D81FB6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE gardener_plant ADD CONSTRAINT FK_13D81FB61D935652 FOREIGN KEY (plant_id) REFERENCES plant (id)');
        $this->addSql('ALTER TABLE watering ADD CONSTRAINT FK_818F9D31A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE watering ADD CONSTRAINT FK_818F9D3135F46CF6 FOREIGN KEY (gardenerplant_id) REFERENCES gardener_plant (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE watering DROP FOREIGN KEY FK_818F9D3135F46CF6');
        $this->addSql('ALTER TABLE gardener_plant DROP FOREIGN KEY FK_13D81FB61D935652');
        $this->addSql('ALTER TABLE gardener_plant DROP FOREIGN KEY FK_13D81FB6A76ED395');
        $this->addSql('ALTER TABLE watering DROP FOREIGN KEY FK_818F9D31A76ED395');
        $this->addSql('DROP TABLE gardener_plant');
        $this->addSql('DROP TABLE plant');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE watering');
    }
}
