<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210312080250 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit CHANGE est_vendu est_vendu TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE en_stock en_stock TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE nb_invendu nb_invendu SMALLINT DEFAULT 0 NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit CHANGE est_vendu est_vendu TINYINT(1) NOT NULL, CHANGE en_stock en_stock TINYINT(1) NOT NULL, CHANGE nb_invendu nb_invendu SMALLINT NOT NULL');
    }
}
