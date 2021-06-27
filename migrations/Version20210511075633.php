<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210511075633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, auteur_id INT NOT NULL, deal_id INT NOT NULL, date_heure DATE NOT NULL, contenu LONGTEXT NOT NULL, INDEX IDX_67F068BC60BB6FE6 (auteur_id), INDEX IDX_67F068BCF60E2305 (deal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deal (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(10000) DEFAULT NULL, titre VARCHAR(255) NOT NULL, lien_du_deal VARCHAR(255) NOT NULL, code_promo VARCHAR(255) DEFAULT NULL, is_expire TINYINT(1) NOT NULL, discr VARCHAR(255) NOT NULL, prix DOUBLE PRECISION DEFAULT NULL, prix_habituel DOUBLE PRECISION DEFAULT NULL, frais_de_port DOUBLE PRECISION DEFAULT NULL, is_livraison_gratuite TINYINT(1) DEFAULT NULL, montant DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deal_groupe (deal_id INT NOT NULL, groupe_id INT NOT NULL, INDEX IDX_10FE0FADF60E2305 (deal_id), INDEX IDX_10FE0FAD7A45358C (groupe_id), PRIMARY KEY(deal_id, groupe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deal_partenaire (deal_id INT NOT NULL, partenaire_id INT NOT NULL, INDEX IDX_D3E10296F60E2305 (deal_id), INDEX IDX_D3E1029698DE13AC (partenaire_id), PRIMARY KEY(deal_id, partenaire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partenaire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vote (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, deal_id INT NOT NULL, valeur INT NOT NULL, INDEX IDX_5A108564FB88E14F (utilisateur_id), INDEX IDX_5A108564F60E2305 (deal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCF60E2305 FOREIGN KEY (deal_id) REFERENCES deal (id)');
        $this->addSql('ALTER TABLE deal_groupe ADD CONSTRAINT FK_10FE0FADF60E2305 FOREIGN KEY (deal_id) REFERENCES deal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE deal_groupe ADD CONSTRAINT FK_10FE0FAD7A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE deal_partenaire ADD CONSTRAINT FK_D3E10296F60E2305 FOREIGN KEY (deal_id) REFERENCES deal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE deal_partenaire ADD CONSTRAINT FK_D3E1029698DE13AC FOREIGN KEY (partenaire_id) REFERENCES partenaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A108564FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A108564F60E2305 FOREIGN KEY (deal_id) REFERENCES deal (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCF60E2305');
        $this->addSql('ALTER TABLE deal_groupe DROP FOREIGN KEY FK_10FE0FADF60E2305');
        $this->addSql('ALTER TABLE deal_partenaire DROP FOREIGN KEY FK_D3E10296F60E2305');
        $this->addSql('ALTER TABLE vote DROP FOREIGN KEY FK_5A108564F60E2305');
        $this->addSql('ALTER TABLE deal_groupe DROP FOREIGN KEY FK_10FE0FAD7A45358C');
        $this->addSql('ALTER TABLE deal_partenaire DROP FOREIGN KEY FK_D3E1029698DE13AC');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE deal');
        $this->addSql('DROP TABLE deal_groupe');
        $this->addSql('DROP TABLE deal_partenaire');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE partenaire');
        $this->addSql('DROP TABLE vote');
    }
}
