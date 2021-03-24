<?php

namespace Solital\Core;

use Solital\Core\Console\Command\CustomCommand;

class ConsoleTest extends CustomCommand
{
    public function create()
    {
        $res = (new CustomCommand())->registerComponent('test', 'desc test');

        var_dump($res);
    }
}
