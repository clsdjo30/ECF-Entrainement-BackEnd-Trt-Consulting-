<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220830064655 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add relation between User and Candidate and Consultant';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'ALTER TABLE user ADD consultant_id INT DEFAULT NULL, ADD candidate_id INT DEFAULT NULL, ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL'
        );
        $this->addSql(
            'ALTER TABLE user ADD CONSTRAINT FK_8D93D64944F779A2 FOREIGN KEY (consultant_id) REFERENCES consultant (id)'
        );
        $this->addSql(
            'ALTER TABLE user ADD CONSTRAINT FK_8D93D64991BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id)'
        );
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64944F779A2 ON user (consultant_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64991BD8781 ON user (candidate_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64944F779A2');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64991BD8781');
        $this->addSql('DROP INDEX UNIQ_8D93D64944F779A2 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D64991BD8781 ON user');
        $this->addSql('ALTER TABLE user DROP consultant_id, DROP candidate_id, DROP created_at, DROP updated_at');
    }
}
