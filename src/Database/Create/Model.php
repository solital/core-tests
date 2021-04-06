<?php

namespace Solital\Core\Database\Create;

use Solital\Core\Database\ORM;

abstract class Model
{
    /**
     * @var string
     */
    protected string $table;

    /**
     * @var string
     */
    protected string $primary_key;

    /**
     * @var array
     */
    protected array $columns;

    /**
     * @return ORM
     */
    protected function instance(): ORM
    {
        $katrina = new ORM($this->table, $this->primary_key, $this->columns);

        return $katrina;
    }
}
