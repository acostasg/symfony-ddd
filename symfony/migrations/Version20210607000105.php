<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Component\Uid\Uuid;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210607000105 extends AbstractMigration
{

    CONST TABLE_NAME_USER = 'User';
    CONST TABLE_NAME_CLIENT = 'ClientMapper';


    public function getDescription() : string
    {
        return 'Generate data for ClientMapper and User table';
    }

    public function up(Schema $schema) : void
    {
        if($schema->hasTable(self::TABLE_NAME_CLIENT)){
            $this->addSql(
                "INSERT INTO app_db.ClientMapper (id, firstName, lastName, mail)
                               VALUES(
                                      '".$this->generateUuid('8CE05088-ED1F-43E9-A415-3B3792655A9B')."',
                                      'Joan',
                                      'Romero', 'joan@gmail.com'
                                      )
                           ");
            $this->addSql(
                "INSERT INTO app_db.ClientMapper (id, firstName, lastName, mail)
                                VALUES(
                                       '".$this->generateUuid('62A0CEB4-0403-4AA6-A6CD-1EE808AD4D23')."',
                                       'Jose',
                                        'Perez',
                                         'jose@gmail.com')
                          ");
        }
        if($schema->hasTable(self::TABLE_NAME_USER)){
            $this->addSql(
                "INSERT INTO app_db.User (id, firstName, lastName)
                                VALUES(
                                       '".$this->generateUuid('8CE05088-ED1F-43E9-A415-3B3792655A9B')."',
                                       'Pereira',
                                       'Antic')
                          ");
            $this->addSql(
                "INSERT INTO app_db.User (id, firstName, lastName)
                                VALUES(
                                       '".$this->generateUuid('62A0CEB4-0403-4AA6-A6CD-1EE808AD4D23')."',
                                       'Sebastian',
                                        'Luis')
                     ");
        }



    }

    public function down(Schema $schema) : void
    {
        if($schema->hasTable(self::TABLE_NAME_CLIENT)){
            $this->addSql("TRUNCATE TABLE ".self::TABLE_NAME_CLIENT);
        }

        if($schema->hasTable(self::TABLE_NAME_USER)){
            $this->addSql("TRUNCATE TABLE ".self::TABLE_NAME_USER);
        }

    }

    /**
     * @return string
     */
    public function generateUuid(string $uuid): string
    {
        return Uuid::fromString($uuid)->toBinary();
    }
}
