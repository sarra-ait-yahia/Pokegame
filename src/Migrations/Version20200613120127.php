<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200613120127 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE capture_lieu (id INT AUTO_INCREMENT NOT NULL, lieu VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE capture_lieu_elementary_type (capture_id INT NOT NULL, elementary_type_id INT NOT NULL, INDEX IDX_D961408C6B301384 (capture_id), INDEX IDX_D961408C4F1868AE (elementary_type_id), PRIMARY KEY(capture_id, elementary_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE capture_lieu_elementary_type ADD CONSTRAINT FK_D961408C6B301384 FOREIGN KEY (capture_id) REFERENCES capture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE capture_lieu_elementary_type ADD CONSTRAINT FK_D961408C4F1868AE FOREIGN KEY (elementary_type_id) REFERENCES elementary_type (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE capture_lieu_elementary_type DROP FOREIGN KEY FK_D961408C6B301384');
        $this->addSql('DROP TABLE capture_lieu');
        $this->addSql('DROP TABLE capture_lieu_elementary_type');
    }
}
