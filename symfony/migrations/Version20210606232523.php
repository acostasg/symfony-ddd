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

    CONST TABLE_NAME_CLIENT = 'ClientMapper';

    public function getDescription() : string
    {
        return 'Create Table ClientMapper';
    }

    public function up(Schema $schema) : void
    {
        if(!$schema->hasTable(self::TABLE_NAME_CLIENT)){

            $table = $schema->createTable(self::TABLE_NAME_CLIENT);
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
            $table->addColumn('mail', 'string', array(
                'nullable' => false,
                'length' => 150
            ));
        }

    }

    public function down(Schema $schema) : void
    {
        if($schema->hasTable(self::TABLE_NAME_CLIENT)){
            $schema->dropTable(self::TABLE_NAME_CLIENT);
        }

    }
}
