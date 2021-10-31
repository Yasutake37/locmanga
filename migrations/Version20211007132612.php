<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211007132612 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, etat TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_manga (commande_id INT NOT NULL, manga_id INT NOT NULL, INDEX IDX_4F3241C082EA2E54 (commande_id), INDEX IDX_4F3241C07B6461 (manga_id), PRIMARY KEY(commande_id, manga_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_series (commande_id INT NOT NULL, series_id INT NOT NULL, INDEX IDX_3844FAF882EA2E54 (commande_id), INDEX IDX_3844FAF85278319C (series_id), PRIMARY KEY(commande_id, series_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE manga (id INT AUTO_INCREMENT NOT NULL, serie_id INT NOT NULL, titre VARCHAR(255) NOT NULL, numeros INT NOT NULL, INDEX IDX_765A9E03D94388BD (serie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE series (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_manga ADD CONSTRAINT FK_4F3241C082EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_manga ADD CONSTRAINT FK_4F3241C07B6461 FOREIGN KEY (manga_id) REFERENCES manga (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_series ADD CONSTRAINT FK_3844FAF882EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_series ADD CONSTRAINT FK_3844FAF85278319C FOREIGN KEY (series_id) REFERENCES series (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE manga ADD CONSTRAINT FK_765A9E03D94388BD FOREIGN KEY (serie_id) REFERENCES series (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_manga DROP FOREIGN KEY FK_4F3241C082EA2E54');
        $this->addSql('ALTER TABLE commande_series DROP FOREIGN KEY FK_3844FAF882EA2E54');
        $this->addSql('ALTER TABLE commande_manga DROP FOREIGN KEY FK_4F3241C07B6461');
        $this->addSql('ALTER TABLE commande_series DROP FOREIGN KEY FK_3844FAF85278319C');
        $this->addSql('ALTER TABLE manga DROP FOREIGN KEY FK_765A9E03D94388BD');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commande_manga');
        $this->addSql('DROP TABLE commande_series');
        $this->addSql('DROP TABLE manga');
        $this->addSql('DROP TABLE series');
    }
}
