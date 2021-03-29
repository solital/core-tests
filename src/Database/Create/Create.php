<?php

namespace Solital\Core\Database\Create;

use Solital\Core\Console\Style\Colors;
use Solital\Core\Console\Command\DatabaseCommand;
use Solital\Core\Database\ORM;
use Solital\Database\Create\SQL;

class Create
{
    /**
     * @var instance
     */
    protected $orm;

    /**
     * @var string
     */
    private string $table;
    
    /**
     * @var string
     */
    private string $primary_key;

    /**
     * @var array
     */
    private array $columns;

    /**
     * Data when creating a standard user
     */
    public function __construct()
    {
        $this->table = "tb_auth";
        $this->primary_key = "id_user";
        $this->columns = [
            "username",
            "password"
        ];

        $this->orm = new ORM($this->table, $this->primary_key, $this->columns);

        (new DatabaseCommand())->checkConnection();
    }

    /**
     * Creates a standard user in the database
     * 
     * @return void
     */
    public function userAuth(): void
    {
        $res = $this->orm
            ->createTable("tb_auth")
            ->int("id_user")->primary()->increment()
            ->varchar("username", 50)->notNull()
            ->varchar("password", 150)->notNull()
            ->closeTable()
            ->build();

        if ($res == true) {
            ## pass = solital
            $this->orm->insert(['solital@email.com', '$2y$10$caZsHBy5/uPkCREwLCSlmOzQHIcCWlYre1IQuX3cxY/zRPyROEflC']);

            $msg = (new Colors())->stringColor("Table and user created successfully!", "green", null, true);
            print_r($msg);
        } else {
            $msg = (new Colors())->stringColor("Error: table not created!", "yellow", "red", true);
            print_r($msg);
        }
    }
}
