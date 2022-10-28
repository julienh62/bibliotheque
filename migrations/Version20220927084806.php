<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220927084806 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE borrow ADD document_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE borrow ADD CONSTRAINT FK_55DBA8B0C33F7837 FOREIGN KEY (document_id) REFERENCES document (id)');
        $this->addSql('CREATE INDEX IDX_55DBA8B0C33F7837 ON borrow (document_id)');
        $this->addSql('ALTER TABLE document ADD relation VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE penalitie ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE penalitie ADD CONSTRAINT FK_56733593A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_56733593A76ED395 ON penalitie (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE borrow DROP FOREIGN KEY FK_55DBA8B0C33F7837');
        $this->addSql('DROP INDEX IDX_55DBA8B0C33F7837 ON borrow');
        $this->addSql('ALTER TABLE borrow DROP document_id');
        $this->addSql('ALTER TABLE document DROP relation');
        $this->addSql('ALTER TABLE penalitie DROP FOREIGN KEY FK_56733593A76ED395');
        $this->addSql('DROP INDEX IDX_56733593A76ED395 ON penalitie');
        $this->addSql('ALTER TABLE penalitie DROP user_id');
    }
}
