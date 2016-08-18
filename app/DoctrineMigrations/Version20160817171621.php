<?php

namespace Zboard\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160817171621 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE zboard_formation_etape_user CHANGE id_user id_user INT DEFAULT NULL, CHANGE id_etape id_etape INT DEFAULT NULL');
        $this->addSql('ALTER TABLE zboard_formation_etape_user ADD CONSTRAINT FK_9DB5D3C36B3CA4B FOREIGN KEY (id_user) REFERENCES zboard_user (id)');
        $this->addSql('ALTER TABLE zboard_formation_etape_user ADD CONSTRAINT FK_9DB5D3C3C6DA34ED FOREIGN KEY (id_etape) REFERENCES zboard_formation_etapes (id)');
        $this->addSql('CREATE INDEX IDX_9DB5D3C36B3CA4B ON zboard_formation_etape_user (id_user)');
        $this->addSql('CREATE INDEX IDX_9DB5D3C3C6DA34ED ON zboard_formation_etape_user (id_etape)');
        $this->addSql('ALTER TABLE zboard_recrutement_vote DROP isCandidature, CHANGE id_user id_user INT DEFAULT NULL');
        $this->addSql('ALTER TABLE zboard_recrutement_vote ADD CONSTRAINT FK_853DA0D56B3CA4B FOREIGN KEY (id_user) REFERENCES zboard_user (id)');
        $this->addSql('CREATE INDEX IDX_853DA0D56B3CA4B ON zboard_recrutement_vote (id_user)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE zboard_formation_etape_user DROP FOREIGN KEY FK_9DB5D3C36B3CA4B');
        $this->addSql('ALTER TABLE zboard_formation_etape_user DROP FOREIGN KEY FK_9DB5D3C3C6DA34ED');
        $this->addSql('DROP INDEX IDX_9DB5D3C36B3CA4B ON zboard_formation_etape_user');
        $this->addSql('DROP INDEX IDX_9DB5D3C3C6DA34ED ON zboard_formation_etape_user');
        $this->addSql('ALTER TABLE zboard_formation_etape_user CHANGE id_user id_user INT NOT NULL, CHANGE id_etape id_etape INT NOT NULL');
        $this->addSql('ALTER TABLE zboard_recrutement_vote DROP FOREIGN KEY FK_853DA0D56B3CA4B');
        $this->addSql('DROP INDEX IDX_853DA0D56B3CA4B ON zboard_recrutement_vote');
        $this->addSql('ALTER TABLE zboard_recrutement_vote ADD isCandidature TINYINT(1) NOT NULL, CHANGE id_user id_user INT NOT NULL');
    }
}
