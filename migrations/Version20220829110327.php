<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220829110327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create Category Entity & relation with Announce';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_64C19C1727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'ALTER TABLE category ADD CONSTRAINT FK_64C19C1727ACA70 FOREIGN KEY (parent_id) REFERENCES category (id) ON DELETE CASCADE'
        );
        $this->addSql('ALTER TABLE announce ADD category_id INT NOT NULL');
        $this->addSql(
            'ALTER TABLE announce ADD CONSTRAINT FK_E6D6DD7512469DE2 FOREIGN KEY (category_id) REFERENCES category (id)'
        );
        $this->addSql('CREATE INDEX IDX_E6D6DD7512469DE2 ON announce (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE announce DROP FOREIGN KEY FK_E6D6DD7512469DE2');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1727ACA70');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP INDEX IDX_E6D6DD7512469DE2 ON announce');
        $this->addSql('ALTER TABLE announce DROP category_id');
    }
}
