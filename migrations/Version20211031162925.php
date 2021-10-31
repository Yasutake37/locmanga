<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211031162925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commande_manga');
        $this->addSql('ALTER TABLE commande ADD manga_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D7B6461 FOREIGN KEY (manga_id) REFERENCES manga (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D7B6461 ON commande (manga_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_manga (commande_id INT NOT NULL, manga_id INT NOT NULL, INDEX IDX_4F3241C082EA2E54 (commande_id), INDEX IDX_4F3241C07B6461 (manga_id), PRIMARY KEY(commande_id, manga_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE commande_manga ADD CONSTRAINT FK_4F3241C07B6461 FOREIGN KEY (manga_id) REFERENCES manga (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_manga ADD CONSTRAINT FK_4F3241C082EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D7B6461');
        $this->addSql('DROP INDEX IDX_6EEAA67D7B6461 ON commande');
        $this->addSql('ALTER TABLE commande DROP manga_id');
    }
}
