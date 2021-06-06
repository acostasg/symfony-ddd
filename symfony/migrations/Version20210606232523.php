<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210606232523 extends AbstractMigration
{

    CONST TABLE_NAME = 'Client';

    public function getDescription() : string
    {
        return 'Create Table Client';
    }

    public function up(Schema $schema) : void
    {
        if(!$schema->hasTable(self::TABLE_NAME)){
            $table = $schema->createTable(self::TABLE_NAME);
            $table->addColumn('id', 'integer', array(
                'autoincrement' => true
            ));
            $table->setPrimaryKey(array('id'));
            $table->addColumn('firstName', 'string', array(
                'nullable' => false,
                'length' => 150
            ));
            $table->addColumn('lastName', 'string', array(
                'nullable' => false,
                'length' => 150
            ));
            $table->addColumn('mail', 'string', array(
                'nullable' => false,
                'length' => 150
            ));

        }

    }

    public function down(Schema $schema) : void
    {
        if($schema->hasTable(self::TABLE_NAME)){
            $schema->dropTable(self::TABLE_NAME);
        }

    }
}
