<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Database original set up
 */
final class Version20200608120050 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Database first set up';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('
            CREATE TABLE sudoku (
                sudoku_uuid VARCHAR(36) NOT NULL,
                grid VARCHAR(81) NOT NULL,
                solvable BOOLEAN NULL,
                created_at DATETIME,
                PRIMARY KEY(sudoku_uuid)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql('
            CREATE TRIGGER before_insert_sudoku
                BEFORE INSERT ON sudoku
                FOR EACH ROW SET
                    new.sudoku_uuid = uuid(),
                    new.created_at = now()'
        );
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE sudoku');
        $this->addSql('DROP TRIGGER before_insert_sudoku');
    }
}
