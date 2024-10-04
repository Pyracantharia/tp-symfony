<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241004123042 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE playlist_subscription ADD user_id INT DEFAULT NULL, ADD playlist_id INT NOT NULL');
        $this->addSql('ALTER TABLE playlist_subscription ADD CONSTRAINT FK_832940CA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE playlist_subscription ADD CONSTRAINT FK_832940C6BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id)');
        $this->addSql('CREATE INDEX IDX_832940CA76ED395 ON playlist_subscription (user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_832940C6BBD148 ON playlist_subscription (playlist_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE playlist_subscription DROP FOREIGN KEY FK_832940CA76ED395');
        $this->addSql('ALTER TABLE playlist_subscription DROP FOREIGN KEY FK_832940C6BBD148');
        $this->addSql('DROP INDEX IDX_832940CA76ED395 ON playlist_subscription');
        $this->addSql('DROP INDEX UNIQ_832940C6BBD148 ON playlist_subscription');
        $this->addSql('ALTER TABLE playlist_subscription DROP user_id, DROP playlist_id');
    }
}
