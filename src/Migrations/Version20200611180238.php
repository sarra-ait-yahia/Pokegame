<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200611180238 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pokemon (id INT AUTO_INCREMENT NOT NULL, type_pokemon_id INT DEFAULT NULL, dresseur_id INT DEFAULT NULL, sexe VARCHAR(2) DEFAULT NULL, xp DOUBLE PRECISION DEFAULT NULL, niveau INT DEFAULT NULL, a_vendre TINYINT(1) DEFAULT NULL, prix DOUBLE PRECISION DEFAULT NULL, date_dernier_entrainement DATE DEFAULT NULL, date_derniere_chasse DATE DEFAULT NULL, INDEX IDX_62DC90F332E4CA1B (type_pokemon_id), INDEX IDX_62DC90F3A1A01CBE (dresseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pokemon_type (id INT AUTO_INCREMENT NOT NULL, type1_id INT DEFAULT NULL, type2_id INT DEFAULT NULL, nom VARCHAR(50) DEFAULT NULL, evolution TINYINT(1) DEFAULT NULL, starter TINYINT(1) DEFAULT NULL, type_courbe_niveau VARCHAR(3) DEFAULT NULL, INDEX IDX_B077296ABFAFA3E1 (type1_id), INDEX IDX_B077296AAD1A0C0F (type2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pokemon ADD CONSTRAINT FK_62DC90F332E4CA1B FOREIGN KEY (type_pokemon_id) REFERENCES pokemon_type (id)');
        $this->addSql('ALTER TABLE pokemon ADD CONSTRAINT FK_62DC90F3A1A01CBE FOREIGN KEY (dresseur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE pokemon_type ADD CONSTRAINT FK_B077296ABFAFA3E1 FOREIGN KEY (type1_id) REFERENCES elementary_type (id)');
        $this->addSql('ALTER TABLE pokemon_type ADD CONSTRAINT FK_B077296AAD1A0C0F FOREIGN KEY (type2_id) REFERENCES elementary_type (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pokemon DROP FOREIGN KEY FK_62DC90F332E4CA1B');
        $this->addSql('DROP TABLE pokemon');
        $this->addSql('DROP TABLE pokemon_type');
    }
}
