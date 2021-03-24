<?php

namespace Solital\Components\Model;

use Solital\Components\Model\Model;

class NameDefault extends Model
{
    public function __construct()
    {
        $this->table = "";
        $this->primary_key = "";
        $this->columns = [];
    }
}
