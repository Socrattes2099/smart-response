<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140329204905 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE case_mt_responses CHANGE crime_cases_id crime_cases_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE crime_questions CHANGE crime_category_id crime_category_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE crime_cases CHANGE message_mo_id message_mo_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE sent_questions CHANGE crime_questions_id crime_questions_id INT DEFAULT NULL, CHANGE crime_cases_id crime_cases_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE crime_question_options CHANGE crime_questions_id crime_questions_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE crime_question_answers CHANGE sent_questions_id sent_questions_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE case_comments CHANGE crime_case_id crime_case_id INT DEFAULT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE case_comments CHANGE crime_case_id crime_case_id INT NOT NULL");
        $this->addSql("ALTER TABLE case_mt_responses CHANGE crime_cases_id crime_cases_id INT NOT NULL");
        $this->addSql("ALTER TABLE crime_cases CHANGE message_mo_id message_mo_id INT NOT NULL");
        $this->addSql("ALTER TABLE crime_question_answers CHANGE sent_questions_id sent_questions_id INT NOT NULL");
        $this->addSql("ALTER TABLE crime_question_options CHANGE crime_questions_id crime_questions_id INT NOT NULL");
        $this->addSql("ALTER TABLE crime_questions CHANGE crime_category_id crime_category_id INT NOT NULL");
        $this->addSql("ALTER TABLE sent_questions CHANGE crime_cases_id crime_cases_id INT NOT NULL, CHANGE crime_questions_id crime_questions_id INT NOT NULL");
    }
}
