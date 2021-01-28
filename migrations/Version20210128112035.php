<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210128112035 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pointretrait CHANGE ouverture ouverture VARCHAR(5) NOT NULL, CHANGE fermeture fermeture VARCHAR(5) NOT NULL, CHANGE jour jour VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE cb CHANGE membre_id membre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande CHANGE facture_id facture_id INT DEFAULT NULL, CHANGE membre_id membre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaires CHANGE membre_id membre_id INT DEFAULT NULL, CHANGE recette_id recette_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fournisseur CHANGE comm_id comm_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livrer RENAME INDEX pr_id TO IDX_E576B73267C663E7');
        $this->addSql('ALTER TABLE membre CHANGE pr_id pr_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit CHANGE four_id four_id INT DEFAULT NULL, CHANGE tp_id tp_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ingredient DROP ingred_qtt, DROP ingred_unite');
        $this->addSql('ALTER TABLE ingredient RENAME INDEX recette_id TO IDX_6BAF787089312FE9');
        $this->addSql('ALTER TABLE ligne_commande DROP lc_qtt');
        $this->addSql('ALTER TABLE ligne_commande RENAME INDEX commande_id TO IDX_3170B74B82EA2E54');
        $this->addSql('ALTER TABLE produit_favori RENAME INDEX membre_id TO IDX_18D769F66A99F74A');
        $this->addSql('ALTER TABLE recette CHANGE cat_id cat_id INT DEFAULT NULL, CHANGE auteur auteur INT DEFAULT NULL');
        $this->addSql('ALTER TABLE favorite RENAME INDEX membre_id TO IDX_68C58ED96A99F74A');
        $this->addSql('ALTER TABLE stream CHANGE streamer_id streamer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE streamer CHANGE membre_id membre_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cb CHANGE membre_id membre_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande CHANGE facture_id facture_id INT NOT NULL, CHANGE membre_id membre_id INT NOT NULL');
        $this->addSql('ALTER TABLE commentaires CHANGE membre_id membre_id INT NOT NULL, CHANGE recette_id recette_id INT NOT NULL');
        $this->addSql('ALTER TABLE favorite RENAME INDEX idx_68c58ed96a99f74a TO membre_id');
        $this->addSql('ALTER TABLE fournisseur CHANGE comm_id comm_id INT NOT NULL');
        $this->addSql('ALTER TABLE ingredient ADD ingred_qtt NUMERIC(15, 2) DEFAULT NULL, ADD ingred_unite VARCHAR(20) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE ingredient RENAME INDEX idx_6baf787089312fe9 TO recette_id');
        $this->addSql('ALTER TABLE ligne_commande ADD lc_qtt NUMERIC(15, 2) NOT NULL');
        $this->addSql('ALTER TABLE ligne_commande RENAME INDEX idx_3170b74b82ea2e54 TO commande_id');
        $this->addSql('ALTER TABLE livrer RENAME INDEX idx_e576b73267c663e7 TO pr_id');
        $this->addSql('ALTER TABLE membre CHANGE pr_id pr_id INT NOT NULL');
        $this->addSql('ALTER TABLE PointRetrait CHANGE ouverture ouverture SMALLINT DEFAULT 0, CHANGE fermeture fermeture SMALLINT DEFAULT 0 NOT NULL, CHANGE jour jour SMALLINT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE produit CHANGE four_id four_id INT NOT NULL, CHANGE tp_id tp_id INT NOT NULL');
        $this->addSql('ALTER TABLE produit_favori RENAME INDEX idx_18d769f66a99f74a TO membre_id');
        $this->addSql('ALTER TABLE recette CHANGE cat_id cat_id INT NOT NULL, CHANGE auteur auteur INT NOT NULL');
        $this->addSql('ALTER TABLE stream CHANGE streamer_id streamer_id INT NOT NULL');
        $this->addSql('ALTER TABLE streamer CHANGE membre_id membre_id INT NOT NULL');
    }
}
