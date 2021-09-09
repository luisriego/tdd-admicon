<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210830101756 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Changes in ´user´ table and adding constraints';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD active TINYINT(1) NOT NULL, ADD token VARCHAR(100) DEFAULT NULL, ADD reset_password_token VARCHAR(100) DEFAULT NULL, ADD created_on DATETIME DEFAULT NULL, ADD updated_on DATETIME DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX U_user_email ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX U_user_email ON user');
        $this->addSql('ALTER TABLE user DROP active, DROP token, DROP reset_password_token, DROP created_on, DROP updated_on CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
