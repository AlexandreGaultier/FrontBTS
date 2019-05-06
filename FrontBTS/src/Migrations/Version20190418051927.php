<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190418051927 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE aeroport (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, ville VARCHAR(25) NOT NULL, pays VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avion (id INT AUTO_INCREMENT NOT NULL, place_eco INT NOT NULL, place_premium INT NOT NULL, place_business INT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE billet (id INT AUTO_INCREMENT NOT NULL, id_client_id INT NOT NULL, id_vol_id INT NOT NULL, prix DOUBLE PRECISION NOT NULL, type_place VARCHAR(10) NOT NULL, INDEX IDX_1F034AF699DED506 (id_client_id), INDEX IDX_1F034AF6B91C4E97 (id_vol_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, sexe_id INT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, date_naissance DATE NOT NULL, motde_passe VARCHAR(20) NOT NULL, identifiant VARCHAR(20) NOT NULL, INDEX IDX_C7440455448F3B3C (sexe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sexe (id INT AUTO_INCREMENT NOT NULL, genre VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vol (id INT AUTO_INCREMENT NOT NULL, aeroport_depart_id INT NOT NULL, aeroport_arrivee_id INT NOT NULL, id_avion_id INT NOT NULL, date_depart DATETIME NOT NULL, date_arrivee DATETIME NOT NULL, place_eco INT NOT NULL, place_premium INT NOT NULL, place_business INT NOT NULL, prix_eco DOUBLE PRECISION NOT NULL, prix_premium DOUBLE PRECISION NOT NULL, prix_business DOUBLE PRECISION NOT NULL, INDEX IDX_95C97EBE3CBAF6E (aeroport_depart_id), INDEX IDX_95C97EBA1B96354 (aeroport_arrivee_id), INDEX IDX_95C97EBD06054D4 (id_avion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE billet ADD CONSTRAINT FK_1F034AF699DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE billet ADD CONSTRAINT FK_1F034AF6B91C4E97 FOREIGN KEY (id_vol_id) REFERENCES vol (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455448F3B3C FOREIGN KEY (sexe_id) REFERENCES sexe (id)');
        $this->addSql('ALTER TABLE vol ADD CONSTRAINT FK_95C97EBE3CBAF6E FOREIGN KEY (aeroport_depart_id) REFERENCES aeroport (id)');
        $this->addSql('ALTER TABLE vol ADD CONSTRAINT FK_95C97EBA1B96354 FOREIGN KEY (aeroport_arrivee_id) REFERENCES aeroport (id)');
        $this->addSql('ALTER TABLE vol ADD CONSTRAINT FK_95C97EBD06054D4 FOREIGN KEY (id_avion_id) REFERENCES avion (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vol DROP FOREIGN KEY FK_95C97EBE3CBAF6E');
        $this->addSql('ALTER TABLE vol DROP FOREIGN KEY FK_95C97EBA1B96354');
        $this->addSql('ALTER TABLE vol DROP FOREIGN KEY FK_95C97EBD06054D4');
        $this->addSql('ALTER TABLE billet DROP FOREIGN KEY FK_1F034AF699DED506');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455448F3B3C');
        $this->addSql('ALTER TABLE billet DROP FOREIGN KEY FK_1F034AF6B91C4E97');
        $this->addSql('DROP TABLE aeroport');
        $this->addSql('DROP TABLE avion');
        $this->addSql('DROP TABLE billet');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE sexe');
        $this->addSql('DROP TABLE vol');
    }
}
