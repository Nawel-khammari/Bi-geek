<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220314171135 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE section_objectif (section_id INT NOT NULL, objectif_id INT NOT NULL, INDEX IDX_7295320DD823E37A (section_id), INDEX IDX_7295320D157D1AD4 (objectif_id), PRIMARY KEY(section_id, objectif_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE section_objectif ADD CONSTRAINT FK_7295320DD823E37A FOREIGN KEY (section_id) REFERENCES section (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE section_objectif ADD CONSTRAINT FK_7295320D157D1AD4 FOREIGN KEY (objectif_id) REFERENCES objectif (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ressource ADD id_chapitre_id INT NOT NULL');
        $this->addSql('ALTER TABLE ressource ADD CONSTRAINT FK_939F45447AC228C FOREIGN KEY (id_chapitre_id) REFERENCES chapitre (id)');
        $this->addSql('CREATE INDEX IDX_939F45447AC228C ON ressource (id_chapitre_id)');
        $this->addSql('ALTER TABLE section ADD id_chapitre_id INT NOT NULL');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEF7AC228C FOREIGN KEY (id_chapitre_id) REFERENCES chapitre (id)');
        $this->addSql('CREATE INDEX IDX_2D737AEF7AC228C ON section (id_chapitre_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE section_objectif');
        $this->addSql('ALTER TABLE chapitre CHANGE titre titre VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nb_section nb_section CHAR(36) NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE cours CHANGE titre titre VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE langue langue VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE objectif CHANGE titre titre VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE ressource DROP FOREIGN KEY FK_939F45447AC228C');
        $this->addSql('DROP INDEX IDX_939F45447AC228C ON ressource');
        $this->addSql('ALTER TABLE ressource DROP id_chapitre_id');
        $this->addSql('ALTER TABLE section DROP FOREIGN KEY FK_2D737AEF7AC228C');
        $this->addSql('DROP INDEX IDX_2D737AEF7AC228C ON section');
        $this->addSql('ALTER TABLE section DROP id_chapitre_id, CHANGE titre titre VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
