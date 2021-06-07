<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210606231734 extends AbstractMigration
{

    CONST TABLE_NAME_USER = 'User';

    public function getDescription() : string
    {
        return 'Create Table User';
    }

    public function up(Schema $schema) : void
    {
        if(!$schema->hasTable(self::TABLE_NAME_USER)){
           $table = $schema->createTable(self::TABLE_NAME_USER);
            $table->addColumn('id', 'uuid', array(
                'nullable' => false,
                'unique' => true
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
        }

    }

    public function down(Schema $schema) : void
    {
        if($schema->hasTable(self::TABLE_NAME_USER)){
            $schema->dropTable(self::TABLE_NAME_USER);
        }

    }
}
