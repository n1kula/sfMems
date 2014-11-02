<?php

namespace Application\Migration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141102140128 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622A32EFC6');
        $this->addSql('DROP INDEX IDX_D8892622A32EFC6 ON rating');
        $this->addSql('ALTER TABLE rating ADD rating SMALLINT NOT NULL, DROP rating_id');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE rating ADD rating_id INT DEFAULT NULL, DROP rating');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622A32EFC6 FOREIGN KEY (rating_id) REFERENCES mem (id)');
        $this->addSql('CREATE INDEX IDX_D8892622A32EFC6 ON rating (rating_id)');
    }
}
