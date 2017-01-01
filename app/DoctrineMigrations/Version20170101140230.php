<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170101140230 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, salt VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_1D1C63B3F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) NOT NULL, fichier VARCHAR(100) DEFAULT NULL, nom_fichier VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_documents (document_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_FEF7D8FC33F7837 (document_id), INDEX IDX_FEF7D8FBCF5E72D (categorie_id), PRIMARY KEY(document_id, categorie_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE action (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE themes_documents (theme_id INT NOT NULL, document_id INT NOT NULL, INDEX IDX_F06DF2C259027487 (theme_id), INDEX IDX_F06DF2C2C33F7837 (document_id), PRIMARY KEY(theme_id, document_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, action_id INT DEFAULT NULL, document_id INT DEFAULT NULL, theme_id INT DEFAULT NULL, dt DATETIME NOT NULL, INDEX IDX_EDBFD5ECFB88E14F (utilisateur_id), INDEX IDX_EDBFD5EC9D32F035 (action_id), INDEX IDX_EDBFD5ECC33F7837 (document_id), INDEX IDX_EDBFD5EC59027487 (theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_documents ADD CONSTRAINT FK_FEF7D8FC33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_documents ADD CONSTRAINT FK_FEF7D8FBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE themes_documents ADD CONSTRAINT FK_F06DF2C259027487 FOREIGN KEY (theme_id) REFERENCES theme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE themes_documents ADD CONSTRAINT FK_F06DF2C2C33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5ECFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5EC9D32F035 FOREIGN KEY (action_id) REFERENCES action (id)');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5ECC33F7837 FOREIGN KEY (document_id) REFERENCES document (id)');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5EC59027487 FOREIGN KEY (theme_id) REFERENCES theme (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5ECFB88E14F');
        $this->addSql('ALTER TABLE categorie_documents DROP FOREIGN KEY FK_FEF7D8FC33F7837');
        $this->addSql('ALTER TABLE themes_documents DROP FOREIGN KEY FK_F06DF2C2C33F7837');
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5ECC33F7837');
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5EC9D32F035');
        $this->addSql('ALTER TABLE categorie_documents DROP FOREIGN KEY FK_FEF7D8FBCF5E72D');
        $this->addSql('ALTER TABLE themes_documents DROP FOREIGN KEY FK_F06DF2C259027487');
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5EC59027487');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE categorie_documents');
        $this->addSql('DROP TABLE action');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE theme');
        $this->addSql('DROP TABLE themes_documents');
        $this->addSql('DROP TABLE historique');
    }
}
