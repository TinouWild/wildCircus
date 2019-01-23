<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190123094536 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles_users (roles_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_3D80FB2C38C751C4 (roles_id), INDEX IDX_3D80FB2C67B3B43D (users_id), PRIMARY KEY(roles_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE about (id INT AUTO_INCREMENT NOT NULL, description LONGTEXT NOT NULL, background VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE performers (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, avatar VARCHAR(255) NOT NULL, biography LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prix (id INT AUTO_INCREMENT NOT NULL, visitor_id INT DEFAULT NULL, period_id INT DEFAULT NULL, price INT NOT NULL, INDEX IDX_F7EFEA5E70BEE6D (visitor_id), INDEX IDX_F7EFEA5EEC8B7ADE (period_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE period (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE performance (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, date DATE NOT NULL, time TIME NOT NULL, background VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE performance_performers (performance_id INT NOT NULL, performers_id INT NOT NULL, INDEX IDX_5428992EB91ADEEE (performance_id), INDEX IDX_5428992EC3A975B0 (performers_id), PRIMARY KEY(performance_id, performers_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visitors (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE roles_users ADD CONSTRAINT FK_3D80FB2C38C751C4 FOREIGN KEY (roles_id) REFERENCES roles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE roles_users ADD CONSTRAINT FK_3D80FB2C67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prix ADD CONSTRAINT FK_F7EFEA5E70BEE6D FOREIGN KEY (visitor_id) REFERENCES visitors (id)');
        $this->addSql('ALTER TABLE prix ADD CONSTRAINT FK_F7EFEA5EEC8B7ADE FOREIGN KEY (period_id) REFERENCES period (id)');
        $this->addSql('ALTER TABLE performance_performers ADD CONSTRAINT FK_5428992EB91ADEEE FOREIGN KEY (performance_id) REFERENCES performance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE performance_performers ADD CONSTRAINT FK_5428992EC3A975B0 FOREIGN KEY (performers_id) REFERENCES performers (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE roles_users DROP FOREIGN KEY FK_3D80FB2C38C751C4');
        $this->addSql('ALTER TABLE roles_users DROP FOREIGN KEY FK_3D80FB2C67B3B43D');
        $this->addSql('ALTER TABLE performance_performers DROP FOREIGN KEY FK_5428992EC3A975B0');
        $this->addSql('ALTER TABLE prix DROP FOREIGN KEY FK_F7EFEA5EEC8B7ADE');
        $this->addSql('ALTER TABLE performance_performers DROP FOREIGN KEY FK_5428992EB91ADEEE');
        $this->addSql('ALTER TABLE prix DROP FOREIGN KEY FK_F7EFEA5E70BEE6D');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE roles_users');
        $this->addSql('DROP TABLE about');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE performers');
        $this->addSql('DROP TABLE prix');
        $this->addSql('DROP TABLE period');
        $this->addSql('DROP TABLE performance');
        $this->addSql('DROP TABLE performance_performers');
        $this->addSql('DROP TABLE visitors');
    }
}
