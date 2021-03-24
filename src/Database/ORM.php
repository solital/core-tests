<?php

namespace Solital\Core\Database;

use Katrina\Katrina;
use Katrina\Connection\DB as DB;
use Solital\Core\Exceptions\NotFoundException;

class ORM extends Katrina
{
    /**
     * @param string $table
     * @param string $primaryKey
     * @param array $columns
     * 
     * @return void
     */
    public function __construct(string $table, string $primaryKey, array $columns)
    {
        if (
            empty($_ENV['DB_DRIVE']) ||
            empty($_ENV['DB_HOST']) ||
            empty($_ENV['DB_NAME']) ||
            empty($_ENV['DB_USER']) ||
            empty($_ENV['DB_PASS'])
        ) {
            NotFoundException::notFound(404, "Database not configured", "It looks like you haven't set up the database connection variables in the '.env' file. Set them up and try again.", "Katrina");
        } else {
            define('DB_CONFIG', [
                'DRIVE' => $_ENV['DB_DRIVE'],
                'HOST' => $_ENV['DB_HOST'],
                'DBNAME' => $_ENV['DB_NAME'],
                'USER' => $_ENV['DB_USER'],
                'PASS' => $_ENV['DB_PASS'],
                'SQLITE_DIR' => $_ENV['SQLITE_DIR']
            ]);
        }

        parent::__construct($table, $primaryKey, $columns);
    }

    /**
     * @param  mixed $sql
     * 
     * @return void
     */
    public static function query($sql)
    {
        return DB::query($sql);
    }

    /**
     * @param  mixed $sql
     * 
     * @return void
     */
    public static function prepare($sql)
    {
        return DB::prepare($sql);
    }
}
