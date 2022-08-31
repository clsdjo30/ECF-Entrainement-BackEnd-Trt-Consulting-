<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220830043934 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create ApplyValidation.php, ApplyValidationRepository.php, ApplyValidationTest.php - Add Relation with Announce & Candidate - Make Test is True - Make Migration';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'CREATE TABLE apply_validation (id INT AUTO_INCREMENT NOT NULL, candidate_id INT NOT NULL, announce_id INT NOT NULL, candidate_is_valid TINYINT(1) NOT NULL, INDEX IDX_A46BFC9091BD8781 (candidate_id), INDEX IDX_A46BFC906F5DA3DE (announce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'ALTER TABLE apply_validation ADD CONSTRAINT FK_A46BFC9091BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id)'
        );
        $this->addSql(
            'ALTER TABLE apply_validation ADD CONSTRAINT FK_A46BFC906F5DA3DE FOREIGN KEY (announce_id) REFERENCES announce (id)'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apply_validation DROP FOREIGN KEY FK_A46BFC9091BD8781');
        $this->addSql('ALTER TABLE apply_validation DROP FOREIGN KEY FK_A46BFC906F5DA3DE');
        $this->addSql('DROP TABLE apply_validation');
    }
}
