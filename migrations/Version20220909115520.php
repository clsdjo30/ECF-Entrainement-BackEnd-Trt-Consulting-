<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220909115520 extends AbstractMigration
{
    public function getDescription(): string
    {
        return ' Refactor all migrations in One Without Address & Company';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'CREATE TABLE announce (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, recruiter_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, experience VARCHAR(255) NOT NULL, salary INT NOT NULL, hourly VARCHAR(255) NOT NULL, benefits VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, is_valid TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_E6D6DD7512469DE2 (category_id), INDEX IDX_E6D6DD75156BE243 (recruiter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'CREATE TABLE apply_validation (id INT AUTO_INCREMENT NOT NULL, candidate_id INT NOT NULL, announce_id INT NOT NULL, candidate_is_valid TINYINT(1) NOT NULL, INDEX IDX_A46BFC9091BD8781 (candidate_id), INDEX IDX_A46BFC906F5DA3DE (announce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'CREATE TABLE candidate (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, cv_file VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_64C19C1727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'CREATE TABLE consultant (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'CREATE TABLE publish_validation (id INT AUTO_INCREMENT NOT NULL, recruiter_id INT NOT NULL, announce_id INT NOT NULL, announce_is_valid TINYINT(1) NOT NULL, INDEX IDX_92C85D36156BE243 (recruiter_id), UNIQUE INDEX UNIQ_92C85D366F5DA3DE (announce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'CREATE TABLE recruiter (id INT AUTO_INCREMENT NOT NULL, address VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, postal_code INT DEFAULT NULL, company_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, consultant_id INT DEFAULT NULL, candidate_id INT DEFAULT NULL, recruiter_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, is_validated TINYINT(1) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D64944F779A2 (consultant_id), UNIQUE INDEX UNIQ_8D93D64991BD8781 (candidate_id), UNIQUE INDEX UNIQ_8D93D649156BE243 (recruiter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'ALTER TABLE announce ADD CONSTRAINT FK_E6D6DD7512469DE2 FOREIGN KEY (category_id) REFERENCES category (id)'
        );
        $this->addSql(
            'ALTER TABLE announce ADD CONSTRAINT FK_E6D6DD75156BE243 FOREIGN KEY (recruiter_id) REFERENCES recruiter (id)'
        );
        $this->addSql(
            'ALTER TABLE apply_validation ADD CONSTRAINT FK_A46BFC9091BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id)'
        );
        $this->addSql(
            'ALTER TABLE apply_validation ADD CONSTRAINT FK_A46BFC906F5DA3DE FOREIGN KEY (announce_id) REFERENCES announce (id)'
        );
        $this->addSql(
            'ALTER TABLE category ADD CONSTRAINT FK_64C19C1727ACA70 FOREIGN KEY (parent_id) REFERENCES category (id) ON DELETE CASCADE'
        );
        $this->addSql(
            'ALTER TABLE publish_validation ADD CONSTRAINT FK_92C85D36156BE243 FOREIGN KEY (recruiter_id) REFERENCES recruiter (id)'
        );
        $this->addSql(
            'ALTER TABLE publish_validation ADD CONSTRAINT FK_92C85D366F5DA3DE FOREIGN KEY (announce_id) REFERENCES announce (id)'
        );
        $this->addSql(
            'ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)'
        );
        $this->addSql(
            'ALTER TABLE user ADD CONSTRAINT FK_8D93D64944F779A2 FOREIGN KEY (consultant_id) REFERENCES consultant (id)'
        );
        $this->addSql(
            'ALTER TABLE user ADD CONSTRAINT FK_8D93D64991BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id)'
        );
        $this->addSql(
            'ALTER TABLE user ADD CONSTRAINT FK_8D93D649156BE243 FOREIGN KEY (recruiter_id) REFERENCES recruiter (id)'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE announce DROP FOREIGN KEY FK_E6D6DD7512469DE2');
        $this->addSql('ALTER TABLE announce DROP FOREIGN KEY FK_E6D6DD75156BE243');
        $this->addSql('ALTER TABLE apply_validation DROP FOREIGN KEY FK_A46BFC9091BD8781');
        $this->addSql('ALTER TABLE apply_validation DROP FOREIGN KEY FK_A46BFC906F5DA3DE');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1727ACA70');
        $this->addSql('ALTER TABLE publish_validation DROP FOREIGN KEY FK_92C85D36156BE243');
        $this->addSql('ALTER TABLE publish_validation DROP FOREIGN KEY FK_92C85D366F5DA3DE');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64944F779A2');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64991BD8781');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649156BE243');
        $this->addSql('DROP TABLE announce');
        $this->addSql('DROP TABLE apply_validation');
        $this->addSql('DROP TABLE candidate');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE consultant');
        $this->addSql('DROP TABLE publish_validation');
        $this->addSql('DROP TABLE recruiter');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE user');
    }
}
