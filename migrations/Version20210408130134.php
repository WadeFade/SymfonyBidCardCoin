<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210408130134 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE enchere DROP FOREIGN KEY FK_38D1870F61864004');
        $this->addSql('CREATE TABLE vente (id INT AUTO_INCREMENT NOT NULL, adresse_id INT DEFAULT NULL, commissaire_id INT DEFAULT NULL, nom_vente VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, date_start DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', date_end DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_888A2A4C4DE7DC5C (adresse_id), INDEX IDX_888A2A4CF7EA9D21 (commissaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4C4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4CF7EA9D21 FOREIGN KEY (commissaire_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE vente');
        $this->addSql('DROP INDEX IDX_38D1870F61864004 ON enchere');
        $this->addSql('ALTER TABLE enchere DROP salle_vente_id');
        $this->addSql('ALTER TABLE lot ADD vente_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lot ADD CONSTRAINT FK_B81291B7DC7170A FOREIGN KEY (vente_id) REFERENCES vente (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B81291B7DC7170A ON lot (vente_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lot DROP FOREIGN KEY FK_B81291B7DC7170A');
        $this->addSql('CREATE TABLE vente (id INT AUTO_INCREMENT NOT NULL, adresse_id INT DEFAULT NULL, commissaire_id INT DEFAULT NULL, nom_vente VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, date_start DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', date_end DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_15E7EB5E4DE7DC5C (adresse_id), INDEX IDX_15E7EB5EF7EA9D21 (commissaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_15E7EB5E4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_15E7EB5EF7EA9D21 FOREIGN KEY (commissaire_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE vente');
        $this->addSql('ALTER TABLE enchere ADD salle_vente_id INT NOT NULL');
        $this->addSql('ALTER TABLE enchere ADD CONSTRAINT FK_38D1870F61864004 FOREIGN KEY (salle_vente_id) REFERENCES vente (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_38D1870F61864004 ON enchere (salle_vente_id)');
        $this->addSql('DROP INDEX UNIQ_B81291B7DC7170A ON lot');
        $this->addSql('ALTER TABLE lot DROP vente_id');
    }
}
