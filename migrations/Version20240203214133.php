<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240203214133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rssobject DROP modified');
        $this->addSql('ALTER TABLE rssobject ADD CONSTRAINT FK_DE6CA9779D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_DE6CA9779D86650F ON rssobject (user_id_id)');
        $this->addSql('ALTER TABLE user ADD refreshrate INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rssobject DROP FOREIGN KEY FK_DE6CA9779D86650F');
        $this->addSql('DROP INDEX IDX_DE6CA9779D86650F ON rssobject');
        $this->addSql('ALTER TABLE rssobject ADD modified DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE `user` DROP refreshrate');
    }
}
