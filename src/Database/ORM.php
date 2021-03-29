<?php

namespace Solital\Core\Database;

use Katrina\Katrina;
use Katrina\Connection\DB as DB;
use Solital\Core\Exceptions\NotFoundException;

class ORM extends Katrina
{
    private $drive;
    private $host;
    private $name;
    private $user;
    private $pass;
    private $sqlite;
    
    /**
     * @param string $table
     * @param string $primaryKey
     * @param array $columns
     * 
     * @return void
     */
    public function __construct(string $table, string $primaryKey, array $columns)
    {
        $this->drive = $_ENV['DB_DRIVE'];
        $this->host = $_ENV['DB_HOST'];
        $this->name = $_ENV['DB_NAME'];
        $this->user = $_ENV['DB_USER'];
        $this->pass = $_ENV['DB_PASS'];
        $this->sqlite = $_ENV['SQLITE_DIR'];

        if (
            $this->drive == "" ||
            $this->host == "" ||
            $this->name == "" ||
            $this->user == ""
        ) {
            NotFoundException::notFound(404, "Database not configured", "It looks like you haven't set up the database connection variables in the '.env' file. Set them up and try again.", "Katrina");
        }

        if (!defined('DB_CONFIG')) {
            define('DB_CONFIG', [
                'DRIVE' => $this->drive,
                'HOST' => $this->host,
                'DBNAME' => $this->name,
                'USER' => $this->user,
                'PASS' => $this->pass,
                'SQLITE_DIR' => $this->sqlite
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
