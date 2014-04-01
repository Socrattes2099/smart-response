<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140329221102 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE crime_cases ADD crime_category_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE crime_cases ADD CONSTRAINT FK_154CBB139ACF468D FOREIGN KEY (crime_category_id) REFERENCES crime_categories (id)");
        $this->addSql("CREATE INDEX IDX_154CBB139ACF468D ON crime_cases (crime_category_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE crime_cases DROP FOREIGN KEY FK_154CBB139ACF468D");
        $this->addSql("DROP INDEX IDX_154CBB139ACF468D ON crime_cases");
        $this->addSql("ALTER TABLE crime_cases DROP crime_category_id");
    }
}
