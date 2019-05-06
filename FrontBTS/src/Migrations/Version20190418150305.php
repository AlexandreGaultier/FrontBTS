<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190418150305 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455448F3B3C');
        $this->addSql('DROP TABLE exemple');
        $this->addSql('DROP TABLE sexe');
        $this->addSql('ALTER TABLE aeroport DROP ville, CHANGE nom nom VARCHAR(25) NOT NULL');
        $this->addSql('ALTER TABLE avion CHANGE place_eco place_eco INT DEFAULT NULL, CHANGE place_premium place_premium INT DEFAULT NULL, CHANGE place_business place_business INT DEFAULT NULL, CHANGE nom nom VARCHAR(25) NOT NULL');
        $this->addSql('ALTER TABLE billet CHANGE id_vol_id id_vol_id INT DEFAULT NULL, CHANGE prix prix INT NOT NULL, CHANGE type_place type_place VARCHAR(25) NOT NULL');
        $this->addSql('DROP INDEX IDX_C7440455448F3B3C ON client');
        $this->addSql('ALTER TABLE client ADD mot_de_passe VARCHAR(50) NOT NULL, ADD sexe VARCHAR(25) NOT NULL, DROP sexe_id, DROP motde_passe, CHANGE nom nom VARCHAR(25) NOT NULL, CHANGE prenom prenom VARCHAR(25) NOT NULL, CHANGE identifiant identifiant VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE vol CHANGE date_depart date_depart VARCHAR(25) NOT NULL, CHANGE place_eco place_eco INT DEFAULT NULL, CHANGE place_premium place_premium INT DEFAULT NULL, CHANGE place_business place_business INT DEFAULT NULL, CHANGE prix_eco prix_eco INT DEFAULT NULL, CHANGE prix_premium prix_premium INT DEFAULT NULL, CHANGE prix_business prix_business INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE exemple (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, description LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sexe (id INT AUTO_INCREMENT NOT NULL, genre VARCHAR(25) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE aeroport ADD ville VARCHAR(25) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE nom nom VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE avion CHANGE place_eco place_eco INT NOT NULL, CHANGE place_premium place_premium INT NOT NULL, CHANGE place_business place_business INT NOT NULL, CHANGE nom nom VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE billet CHANGE id_vol_id id_vol_id INT NOT NULL, CHANGE prix prix DOUBLE PRECISION NOT NULL, CHANGE type_place type_place VARCHAR(10) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE client ADD sexe_id INT NOT NULL, ADD motde_passe VARCHAR(20) NOT NULL COLLATE utf8mb4_unicode_ci, DROP mot_de_passe, DROP sexe, CHANGE nom nom VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE prenom prenom VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE identifiant identifiant VARCHAR(20) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455448F3B3C FOREIGN KEY (sexe_id) REFERENCES sexe (id)');
        $this->addSql('CREATE INDEX IDX_C7440455448F3B3C ON client (sexe_id)');
        $this->addSql('ALTER TABLE vol CHANGE date_depart date_depart DATETIME NOT NULL, CHANGE place_eco place_eco INT NOT NULL, CHANGE place_premium place_premium INT NOT NULL, CHANGE place_business place_business INT NOT NULL, CHANGE prix_eco prix_eco DOUBLE PRECISION NOT NULL, CHANGE prix_premium prix_premium DOUBLE PRECISION NOT NULL, CHANGE prix_business prix_business DOUBLE PRECISION NOT NULL');
    }
}
