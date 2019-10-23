<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191023190523 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'NWERC: update default configuration and language settings';
    }

    public function up(Schema $schema): void
    {
        // Update configuration
        $this->addSql(<<<SQL
UPDATE `configuration` SET `value` = '0' WHERE `name` = 'compile_penalty';
UPDATE `configuration` SET `value` = '{"memory-limit":99,"output-limit":99,"run-error":99,"timelimit":99,"wrong-answer":99,"no-output":99,"correct":1}' WHERE `name` = 'results_prio';
UPDATE `configuration` SET `value` = '{"no-output":"wrong-answer"}' WHERE `name` = 'results_remap';
UPDATE `configuration` SET `value` = '2097152' WHERE `name` = 'memory_limit';
UPDATE `configuration` SET `value` = '60' WHERE `name` = 'script_timelimit';
UPDATE `configuration` SET `value` = '2197152' WHERE `name` = 'script_filesize_limit';
UPDATE `configuration` SET `value` = '"2s|20%"' WHERE `name` = 'timelimit_overshoot';
UPDATE `configuration` SET `value` = '0' WHERE `name` = 'lazy_eval_results';
UPDATE `configuration` SET `value` = '{"jury":"Jury","domjudge":"DOMjudge","misc":"General Issues"}' WHERE `name` = 'clar_queues';
UPDATE `configuration` SET `value` = '"jury"' WHERE `name` = 'clar_default_problem_queue';
UPDATE `configuration` SET `value` = '1' WHERE `name` = 'show_pending';
UPDATE `configuration` SET `value` = '1' WHERE `name` = 'show_affiliation_logos';
UPDATE `configuration` SET `value` = '200' WHERE `name` = 'thumbnail_size';
UPDATE `configuration` SET `value` = '1' WHERE `name` = 'show_limits_on_team_page';
UPDATE `configuration` SET `value` = '1' WHERE `name` = 'data_source';
UPDATE `configuration` SET `value` = '["ipaddress"]' WHERE `name` = 'auth_methods';
UPDATE `configuration` SET `value` = '1' WHERE `name` = 'ip_autologin';

UPDATE `language` SET `require_entry_point` = 1, `allow_submit` = 1 WHERE `langid` IN ('java', 'kt', 'py2', 'py3');
SQL
        );
    }

    public function down(Schema $schema): void
    {
        $this->abortIf(
            true,
            'Downgrading to non-NWERC schema not supported'
        );
    }
}
