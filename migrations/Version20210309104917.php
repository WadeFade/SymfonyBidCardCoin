<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210309104917 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, id_adresse VARCHAR(255) NOT NULL, num INT NOT NULL, rue VARCHAR(255) NOT NULL, ville VARCHAR(100) NOT NULL, code_postal VARCHAR(50) NOT NULL, pays VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adresse_user (adresse_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_7D95019F4DE7DC5C (adresse_id), INDEX IDX_7D95019FA76ED395 (user_id), PRIMARY KEY(adresse_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, id_categorie VARCHAR(255) NOT NULL, nom_categorie VARCHAR(50) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enchere (id INT AUTO_INCREMENT NOT NULL, lot_id INT NOT NULL, ordre_achat_id INT DEFAULT NULL, salle_vente_id INT NOT NULL, commissaire_id INT NOT NULL, encherisseur_id INT NOT NULL, id_enchere VARCHAR(255) NOT NULL, date_enchere DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', prix_propose DOUBLE PRECISION NOT NULL, est_adjuge TINYINT(1) NOT NULL, INDEX IDX_38D1870FA8CBA5F7 (lot_id), INDEX IDX_38D1870F5DD2787F (ordre_achat_id), INDEX IDX_38D1870F61864004 (salle_vente_id), INDEX IDX_38D1870FF7EA9D21 (commissaire_id), INDEX IDX_38D1870F91D60FC6 (encherisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estimation (id INT AUTO_INCREMENT NOT NULL, produit_id INT NOT NULL, commissaire_id INT NOT NULL, id_estimation VARCHAR(255) NOT NULL, prix_estimation DOUBLE PRECISION NOT NULL, date_estimation DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_D0527024F347EFB (produit_id), INDEX IDX_D0527024F7EA9D21 (commissaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lot (id INT AUTO_INCREMENT NOT NULL, id_lot VARCHAR(255) NOT NULL, nom_lot VARCHAR(50) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordre_achat (id INT AUTO_INCREMENT NOT NULL, lot_id INT NOT NULL, orderer_id INT NOT NULL, id_ordre_achat VARCHAR(255) NOT NULL, prix_max DOUBLE PRECISION NOT NULL, date_ordre_achat DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_71306AD9A8CBA5F7 (lot_id), INDEX IDX_71306AD9DF123119 (orderer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paiement (id INT AUTO_INCREMENT NOT NULL, enchere_id INT NOT NULL, id_paiement VARCHAR(255) NOT NULL, type_paiement VARCHAR(50) DEFAULT NULL, validation_paiement TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_B1DC7A1EE80B6EFB (enchere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, produit_id INT NOT NULL, id_photo VARCHAR(255) NOT NULL, nom_photo VARCHAR(50) NOT NULL, url_photo LONGTEXT NOT NULL, INDEX IDX_14B78418F347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, lot_id INT DEFAULT NULL, stockage_id INT DEFAULT NULL, vendeur_id INT NOT NULL, acquereur_id INT DEFAULT NULL, id_produit VARCHAR(255) NOT NULL, nom_produit VARCHAR(50) NOT NULL, description LONGTEXT DEFAULT NULL, prix_reserve DOUBLE PRECISION NOT NULL, prix_depart DOUBLE PRECISION DEFAULT NULL, prix_vente DOUBLE PRECISION DEFAULT NULL, est_vendu TINYINT(1) NOT NULL, en_stock TINYINT(1) NOT NULL, nb_invendu SMALLINT NOT NULL, INDEX IDX_29A5EC27BCF5E72D (categorie_id), INDEX IDX_29A5EC27A8CBA5F7 (lot_id), INDEX IDX_29A5EC27DAA83D7F (stockage_id), INDEX IDX_29A5EC27858C065E (vendeur_id), INDEX IDX_29A5EC27706A94B3 (acquereur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vente (id INT AUTO_INCREMENT NOT NULL, adresse_id INT DEFAULT NULL, id_salle_enchere VARCHAR(255) NOT NULL, nom_vente VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_15E7EB5E4DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stockage (id INT AUTO_INCREMENT NOT NULL, adresse_id INT DEFAULT NULL, id_stockage VARCHAR(255) NOT NULL, INDEX IDX_CABCB4924DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, date_naissance DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', telephone VARCHAR(50) NOT NULL, verif_identite TINYINT(1) NOT NULL, mode_paiement SMALLINT NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse_user ADD CONSTRAINT FK_7D95019F4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE adresse_user ADD CONSTRAINT FK_7D95019FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enchere ADD CONSTRAINT FK_38D1870FA8CBA5F7 FOREIGN KEY (lot_id) REFERENCES lot (id)');
        $this->addSql('ALTER TABLE enchere ADD CONSTRAINT FK_38D1870F5DD2787F FOREIGN KEY (ordre_achat_id) REFERENCES ordre_achat (id)');
        $this->addSql('ALTER TABLE enchere ADD CONSTRAINT FK_38D1870F61864004 FOREIGN KEY (salle_vente_id) REFERENCES vente (id)');
        $this->addSql('ALTER TABLE enchere ADD CONSTRAINT FK_38D1870FF7EA9D21 FOREIGN KEY (commissaire_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE enchere ADD CONSTRAINT FK_38D1870F91D60FC6 FOREIGN KEY (encherisseur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE estimation ADD CONSTRAINT FK_D0527024F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE estimation ADD CONSTRAINT FK_D0527024F7EA9D21 FOREIGN KEY (commissaire_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ordre_achat ADD CONSTRAINT FK_71306AD9A8CBA5F7 FOREIGN KEY (lot_id) REFERENCES lot (id)');
        $this->addSql('ALTER TABLE ordre_achat ADD CONSTRAINT FK_71306AD9DF123119 FOREIGN KEY (orderer_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EE80B6EFB FOREIGN KEY (enchere_id) REFERENCES enchere (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27A8CBA5F7 FOREIGN KEY (lot_id) REFERENCES lot (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27DAA83D7F FOREIGN KEY (stockage_id) REFERENCES stockage (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27858C065E FOREIGN KEY (vendeur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27706A94B3 FOREIGN KEY (acquereur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_15E7EB5E4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE stockage ADD CONSTRAINT FK_CABCB4924DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse_user DROP FOREIGN KEY FK_7D95019F4DE7DC5C');
        $this->addSql('ALTER TABLE vente DROP FOREIGN KEY FK_15E7EB5E4DE7DC5C');
        $this->addSql('ALTER TABLE stockage DROP FOREIGN KEY FK_CABCB4924DE7DC5C');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27BCF5E72D');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1EE80B6EFB');
        $this->addSql('ALTER TABLE enchere DROP FOREIGN KEY FK_38D1870FA8CBA5F7');
        $this->addSql('ALTER TABLE ordre_achat DROP FOREIGN KEY FK_71306AD9A8CBA5F7');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27A8CBA5F7');
        $this->addSql('ALTER TABLE enchere DROP FOREIGN KEY FK_38D1870F5DD2787F');
        $this->addSql('ALTER TABLE estimation DROP FOREIGN KEY FK_D0527024F347EFB');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418F347EFB');
        $this->addSql('ALTER TABLE enchere DROP FOREIGN KEY FK_38D1870F61864004');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27DAA83D7F');
        $this->addSql('ALTER TABLE adresse_user DROP FOREIGN KEY FK_7D95019FA76ED395');
        $this->addSql('ALTER TABLE enchere DROP FOREIGN KEY FK_38D1870FF7EA9D21');
        $this->addSql('ALTER TABLE enchere DROP FOREIGN KEY FK_38D1870F91D60FC6');
        $this->addSql('ALTER TABLE estimation DROP FOREIGN KEY FK_D0527024F7EA9D21');
        $this->addSql('ALTER TABLE ordre_achat DROP FOREIGN KEY FK_71306AD9DF123119');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27858C065E');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27706A94B3');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE adresse_user');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE enchere');
        $this->addSql('DROP TABLE estimation');
        $this->addSql('DROP TABLE lot');
        $this->addSql('DROP TABLE ordre_achat');
        $this->addSql('DROP TABLE paiement');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE vente');
        $this->addSql('DROP TABLE stockage');
        $this->addSql('DROP TABLE user');
    }
}
