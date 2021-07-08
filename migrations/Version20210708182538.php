<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210708182538 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE citation (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, libelle LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_FABD9C7EB03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, quoted_at_id INT NOT NULL, libelle VARCHAR(240) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_67F068BCB03A8386 (created_by_id), INDEX IDX_67F068BC5C9317E (quoted_at_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE citation ADD CONSTRAINT FK_FABD9C7EB03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCB03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC5C9317E FOREIGN KEY (quoted_at_id) REFERENCES citation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC5C9317E');
        $this->addSql('ALTER TABLE citation DROP FOREIGN KEY FK_FABD9C7EB03A8386');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCB03A8386');
        $this->addSql('DROP TABLE citation');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE `user`');
    }
}
