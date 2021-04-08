<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210326074117 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vente ADD commissaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_15E7EB5EF7EA9D21 FOREIGN KEY (commissaire_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_15E7EB5EF7EA9D21 ON vente (commissaire_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vente DROP FOREIGN KEY FK_15E7EB5EF7EA9D21');
        $this->addSql('DROP INDEX IDX_15E7EB5EF7EA9D21 ON vente');
        $this->addSql('ALTER TABLE vente DROP commissaire_id');
    }
}
