<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220830055728 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create PublishValidation.php? PublishValidationRepository.php? PublishValidationTest.php - Add Relation with Announce & Recruiter - Make Test is True - Add TEst in Announce & Recruiter -  Make Migration';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'CREATE TABLE publish_validation (id INT AUTO_INCREMENT NOT NULL, recruiter_id INT NOT NULL, announce_id INT NOT NULL, announce_is_valid TINYINT(1) NOT NULL, INDEX IDX_92C85D36156BE243 (recruiter_id), UNIQUE INDEX UNIQ_92C85D366F5DA3DE (announce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'ALTER TABLE publish_validation ADD CONSTRAINT FK_92C85D36156BE243 FOREIGN KEY (recruiter_id) REFERENCES recruiter (id)'
        );
        $this->addSql(
            'ALTER TABLE publish_validation ADD CONSTRAINT FK_92C85D366F5DA3DE FOREIGN KEY (announce_id) REFERENCES announce (id)'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE publish_validation DROP FOREIGN KEY FK_92C85D36156BE243');
        $this->addSql('ALTER TABLE publish_validation DROP FOREIGN KEY FK_92C85D366F5DA3DE');
        $this->addSql('DROP TABLE publish_validation');
    }
}
