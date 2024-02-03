<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240203164649 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rssobject (id INT AUTO_INCREMENT NOT NULL, url_string VARCHAR(500) NOT NULL, active TINYINT(1) NOT NULL, modified DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (`id` int NOT NULL, `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL, `roles` json NOT NULL, `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
        
        $this->addSql('ALTER TABLE rssobject DROP modified, CHANGE user_id_id userid_id INT NOT NULL, CHANGE url_string url VARCHAR(500) NOT NULL');
        $this->addSql('ALTER TABLE rssobject ADD CONSTRAINT FK_DE6CA97758E0A285 FOREIGN KEY (userid_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_DE6CA97758E0A285 ON rssobject (userid_id)');

        $this->addSql('INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES (3, \'pirk.lajos@gmail.com\', \'[\"ROLE_ADMIN\"]\', \'$2y$13$2fRvuPBSlRBy8hn44Hpwk.ktqV7D2cU3V/7kH7T3Nr.b2.4BV5.VS\');'); //password is, as it is :)
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rssobject DROP FOREIGN KEY FK_DE6CA97758E0A285');
        $this->addSql('DROP INDEX IDX_DE6CA97758E0A285 ON rssobject');
        $this->addSql('ALTER TABLE rssobject ADD modified DATE DEFAULT NULL, CHANGE url url_string VARCHAR(500) NOT NULL, CHANGE userid_id user_id_id INT NOT NULL');
        $this->addSql('DROP TABLE rssobject');
    }
}
