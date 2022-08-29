<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220829140832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create Recruiter.php, RecruiterRepository.php RecruiterTest.php - Add Relation between Recruiter and Announce, company & User - Add Relation between Address & Company';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'CREATE TABLE recruiter (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, UNIQUE INDEX UNIQ_DE8633D89D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'ALTER TABLE recruiter ADD CONSTRAINT FK_DE8633D89D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)'
        );
        $this->addSql('ALTER TABLE announce ADD recruiter_id INT NOT NULL');
        $this->addSql(
            'ALTER TABLE announce ADD CONSTRAINT FK_E6D6DD75156BE243 FOREIGN KEY (recruiter_id) REFERENCES recruiter (id)'
        );
        $this->addSql('CREATE INDEX IDX_E6D6DD75156BE243 ON announce (recruiter_id)');
        $this->addSql('ALTER TABLE company ADD recruiter_id INT NOT NULL, ADD address_id_id INT NOT NULL');
        $this->addSql(
            'ALTER TABLE company ADD CONSTRAINT FK_4FBF094F156BE243 FOREIGN KEY (recruiter_id) REFERENCES recruiter (id)'
        );
        $this->addSql(
            'ALTER TABLE company ADD CONSTRAINT FK_4FBF094F48E1E977 FOREIGN KEY (address_id_id) REFERENCES address (id)'
        );
        $this->addSql('CREATE INDEX IDX_4FBF094F156BE243 ON company (recruiter_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4FBF094F48E1E977 ON company (address_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE announce DROP FOREIGN KEY FK_E6D6DD75156BE243');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F156BE243');
        $this->addSql('ALTER TABLE recruiter DROP FOREIGN KEY FK_DE8633D89D86650F');
        $this->addSql('DROP TABLE recruiter');
        $this->addSql('DROP INDEX IDX_E6D6DD75156BE243 ON announce');
        $this->addSql('ALTER TABLE announce DROP recruiter_id');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F48E1E977');
        $this->addSql('DROP INDEX IDX_4FBF094F156BE243 ON company');
        $this->addSql('DROP INDEX UNIQ_4FBF094F48E1E977 ON company');
        $this->addSql('ALTER TABLE company DROP recruiter_id, DROP address_id_id');
    }
}
