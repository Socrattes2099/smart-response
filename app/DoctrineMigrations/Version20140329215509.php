<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140329215509 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE GeneralQuestion (id INT AUTO_INCREMENT NOT NULL, question VARCHAR(255) NOT NULL, question_number INT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE crime_cases CHANGE description description LONGTEXT DEFAULT NULL");
        $this->addSql("CREATE UNIQUE INDEX unique_question_number ON crime_question_options (option_number, crime_questions_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("DROP TABLE GeneralQuestion");
        $this->addSql("ALTER TABLE crime_cases CHANGE description description LONGTEXT NOT NULL");
        $this->addSql("DROP INDEX unique_question_number ON crime_question_options");
    }
}
