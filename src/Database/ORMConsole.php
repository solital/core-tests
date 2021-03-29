<?php

namespace Solital\Core\Database;

use Solital\Core\Database\Create\Create;
use Solital\Core\Console\Command\CustomCommand;
use Solital\Core\Console\Command\DatabaseCommand;
use Solital\Core\Console\Command\CustomConsoleInterface;

class ORMConsole extends CustomCommand implements CustomConsoleInterface
{
    #use SQLTrait;
    
    /**
     * @return array
     */
    public function execute(): array
    {
        return [
            'katrina-auth' => 'katrinaAuth',
            'katrina-dump' => 'dumpDb'
        ];
    }

    /**
     * @return ORMConsole
     */
    public function katrinaAuth(): ORMConsole
    {
        (new Create())->userAuth();

        return $this;
    }

    /**
     * @return ORMConsole
     */
    public function dumpDb(): ORMConsole
    {
        (new DatabaseCommand())->dump();

        return $this;
    }
}
