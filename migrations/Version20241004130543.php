<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241004130543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media ADD media_type LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', ADD titre VARCHAR(255) NOT NULL, ADD description LONGTEXT DEFAULT NULL, ADD long_desc LONGTEXT NOT NULL, ADD release_date DATE DEFAULT NULL, ADD image VARCHAR(255) DEFAULT NULL, ADD staff JSON DEFAULT NULL, ADD cast JSON DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media DROP media_type, DROP titre, DROP description, DROP long_desc, DROP release_date, DROP image, DROP staff, DROP cast');
    }
}
