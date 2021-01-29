<?php

declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210127103615 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pointretrait (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(150) NOT NULL, adresse VARCHAR(255) NOT NULL, cp VARCHAR(5) NOT NULL, ville VARCHAR(150) NOT NULL, description LONGTEXT DEFAULT NULL, image VARCHAR(5) DEFAULT NULL, ouverture int NOT NULL, fermeture int NOT NULL, jour int NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cb (id INT AUTO_INCREMENT NOT NULL, membre_id INT DEFAULT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, numero VARCHAR(50) NOT NULL, date DATE NOT NULL, INDEX membre_id (membre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, facture_id INT DEFAULT NULL, membre_id INT DEFAULT NULL, date DATE DEFAULT NULL, cout_total NUMERIC(10, 2) DEFAULT NULL, INDEX membre_id (membre_id), INDEX facture_id (facture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaires (id INT AUTO_INCREMENT NOT NULL, membre_id INT DEFAULT NULL, recette_id INT DEFAULT NULL, contenu TEXT NOT NULL, date DATETIME NOT NULL, rating_P INT DEFAULT NULL, rating_N INT DEFAULT NULL, INDEX recette_id (recette_id), INDEX membre_id (membre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commercial (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, tel VARCHAR(10) DEFAULT NULL, email VARCHAR(100) NOT NULL, mdp VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, date_edition DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, comm_id INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, adresse VARCHAR(150) DEFAULT NULL, cp VARCHAR(5) NOT NULL, ville VARCHAR(100) NOT NULL, tel VARCHAR(10) NOT NULL, email VARCHAR(100) NOT NULL, photo VARCHAR(4) DEFAULT NULL, descr TEXT DEFAULT NULL, INDEX comm_id (comm_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livrer (four_id INT NOT NULL, pr_id INT NOT NULL, INDEX IDX_E576B732E5AC00A4 (four_id), INDEX IDX_E576B73267C663E7 (pr_id), PRIMARY KEY(four_id, pr_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre (id INT AUTO_INCREMENT NOT NULL, pr_id INT DEFAULT NULL, civilite VARCHAR(4) NOT NULL, prenom VARCHAR(50) NOT NULL, nom VARCHAR(50) NOT NULL, adresse VARCHAR(150) DEFAULT NULL, cp VARCHAR(5) DEFAULT NULL, ville VARCHAR(50) DEFAULT NULL, tel VARCHAR(10) DEFAULT NULL, email VARCHAR(100) NOT NULL, bloque TINYINT(1) NOT NULL, pseudo VARCHAR(20) DEFAULT NULL, photo VARCHAR(4) DEFAULT NULL, mdp VARCHAR(100) NOT NULL, niveau INT DEFAULT NULL, inscription DATE NOT NULL, desinscription DATE DEFAULT NULL, descr VARCHAR(300) DEFAULT NULL, INDEX pr_id (pr_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, four_id INT DEFAULT NULL, tp_id INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, ref VARCHAR(10) NOT NULL, stock NUMERIC(15, 2) DEFAULT NULL, prix NUMERIC(6, 2) NOT NULL, saison INT DEFAULT NULL, descr TEXT DEFAULT NULL, photo VARCHAR(4) NOT NULL, INDEX four_id (four_id), INDEX tp_id (tp_id), UNIQUE INDEX ref (ref), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (produit_id INT NOT NULL, recette_id INT NOT NULL, INDEX IDX_6BAF7870F347EFB (produit_id), INDEX IDX_6BAF787089312FE9 (recette_id), PRIMARY KEY(produit_id, recette_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_commande (produit_id INT NOT NULL, commande_id INT NOT NULL, INDEX IDX_3170B74BF347EFB (produit_id), INDEX IDX_3170B74B82EA2E54 (commande_id), PRIMARY KEY(produit_id, commande_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_favori (produit_id INT NOT NULL, membre_id INT NOT NULL, INDEX IDX_18D769F6F347EFB (produit_id), INDEX IDX_18D769F66A99F74A (membre_id), PRIMARY KEY(produit_id, membre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette (id INT AUTO_INCREMENT NOT NULL, cat_id INT DEFAULT NULL, auteur INT DEFAULT NULL, theme_id INT DEFAULT NULL, nom VARCHAR(50) NOT NULL, active TINYINT(1) DEFAULT NULL, descr TEXT NOT NULL, photo VARCHAR(4) DEFAULT NULL, rating_P INT DEFAULT NULL, rating_N INT DEFAULT NULL, tps_prep INT NOT NULL, tps_cuisson INT DEFAULT NULL, portion INT NOT NULL, difficulte INT NOT NULL, INDEX membre_id (auteur), INDEX cat_id (cat_id), INDEX theme_id (theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favorite (recette_id INT NOT NULL, membre_id INT NOT NULL, INDEX IDX_68C58ED989312FE9 (recette_id), INDEX IDX_68C58ED96A99F74A (membre_id), PRIMARY KEY(recette_id, membre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stream (id INT AUTO_INCREMENT NOT NULL, streamer_id INT DEFAULT NULL, st_date DATE NOT NULL, nom VARCHAR(100) NOT NULL, st_url VARCHAR(200) NOT NULL, descr VARCHAR(300) DEFAULT NULL, INDEX streamer_id (streamer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE streamer (id INT AUTO_INCREMENT NOT NULL, membre_id INT DEFAULT NULL, date_debut DATE NOT NULL, date_fin DATE DEFAULT NULL, INDEX membre_id (membre_id), UNIQUE INDEX id (id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_produit (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, descr VARCHAR(200) DEFAULT NULL, photo VARCHAR(4) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cb ADD CONSTRAINT FK_ACB52AEF6A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D7F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D6A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C46A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C489312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE fournisseur ADD CONSTRAINT FK_369ECA32EF7EB489 FOREIGN KEY (comm_id) REFERENCES commercial (id)');
        $this->addSql('ALTER TABLE livrer ADD CONSTRAINT FK_E576B732E5AC00A4 FOREIGN KEY (four_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE livrer ADD CONSTRAINT FK_E576B73267C663E7 FOREIGN KEY (pr_id) REFERENCES pointretrait (id)');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB2967C663E7 FOREIGN KEY (pr_id) REFERENCES pointretrait (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27E5AC00A4 FOREIGN KEY (four_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27384F0DAC FOREIGN KEY (tp_id) REFERENCES type_produit (id)');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF7870F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF787089312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74BF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE produit_favori ADD CONSTRAINT FK_18D769F6F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE produit_favori ADD CONSTRAINT FK_18D769F66A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB6390E6ADA943 FOREIGN KEY (cat_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB639055AB140 FOREIGN KEY (auteur) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB639059027487 FOREIGN KEY (theme_id) REFERENCES theme (id)');
        $this->addSql('ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED989312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED96A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE stream ADD CONSTRAINT FK_F0E9BE1C25F432AD FOREIGN KEY (streamer_id) REFERENCES streamer (id)');
        $this->addSql('ALTER TABLE streamer ADD CONSTRAINT FK_2DF6AE326A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livrer DROP FOREIGN KEY FK_E576B73267C663E7');
        $this->addSql('ALTER TABLE membre DROP FOREIGN KEY FK_F6B4FB2967C663E7');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB6390E6ADA943');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74B82EA2E54');
        $this->addSql('ALTER TABLE fournisseur DROP FOREIGN KEY FK_369ECA32EF7EB489');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D7F2DEE08');
        $this->addSql('ALTER TABLE livrer DROP FOREIGN KEY FK_E576B732E5AC00A4');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27E5AC00A4');
        $this->addSql('ALTER TABLE cb DROP FOREIGN KEY FK_ACB52AEF6A99F74A');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D6A99F74A');
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C46A99F74A');
        $this->addSql('ALTER TABLE produit_favori DROP FOREIGN KEY FK_18D769F66A99F74A');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB639055AB140');
        $this->addSql('ALTER TABLE favorite DROP FOREIGN KEY FK_68C58ED96A99F74A');
        $this->addSql('ALTER TABLE streamer DROP FOREIGN KEY FK_2DF6AE326A99F74A');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF7870F347EFB');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74BF347EFB');
        $this->addSql('ALTER TABLE produit_favori DROP FOREIGN KEY FK_18D769F6F347EFB');
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C489312FE9');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF787089312FE9');
        $this->addSql('ALTER TABLE favorite DROP FOREIGN KEY FK_68C58ED989312FE9');
        $this->addSql('ALTER TABLE stream DROP FOREIGN KEY FK_F0E9BE1C25F432AD');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB639059027487');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27384F0DAC');
        $this->addSql('DROP TABLE pointretrait');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE cb');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commentaires');
        $this->addSql('DROP TABLE commercial');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE livrer');
        $this->addSql('DROP TABLE membre');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE ligne_commande');
        $this->addSql('DROP TABLE produit_favori');
        $this->addSql('DROP TABLE recette');
        $this->addSql('DROP TABLE favorite');
        $this->addSql('DROP TABLE stream');
        $this->addSql('DROP TABLE streamer');
        $this->addSql('DROP TABLE theme');
        $this->addSql('DROP TABLE type_produit');
    }
}
