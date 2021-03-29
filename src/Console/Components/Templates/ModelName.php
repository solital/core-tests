<?php

namespace Solital\Components\Model;

use Solital\Components\Model\Model;

class NameDefault extends Model
{
    /**
     * Construct
     */
    public function __construct()
    {
        $this->table = "";
        $this->primary_key = "";
        $this->columns = [];
    }
}
