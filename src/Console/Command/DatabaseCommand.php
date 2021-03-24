<?php

namespace Solital\Core\Console\Command;

use Solital\Core\Console\Style\Colors;
use Solital\Core\Database\Create\Dump;

class DatabaseCommand
{
    /**
     * @return DatabaseCommand
     */
    public function checkConnection(): DatabaseCommand
    {
        if (
            empty($_ENV['DB_DRIVE']) ||
            empty($_ENV['DB_HOST']) ||
            empty($_ENV['DB_NAME']) ||
            empty($_ENV['DB_USER']) ||
            empty($_ENV['DB_PASS'])
        ) {
            $msg = (new Colors())->stringColor("Error: Database not connected!", "yellow", "red", true);
            print_r($msg);

            die;
        }

        return $this;
    }
    
    /**
     * @return DatabaseCommand
     */
    public function dump(): DatabaseCommand
    {
        $dir = dirname(__DIR__) . "app" . DIRECTORY_SEPARATOR . "Dump" . DIRECTORY_SEPARATOR;

        $res = (new Dump())->dumpDatabase($dir);

        if ($res == true) {
            $msg = $this->color->stringColor("Dump done successfully!", "green", null, true);
            print_r($msg);

            die;
        } else {
            $msg = (new Colors())->stringColor("Error dumping the database! ", "yellow", "red", true);
            print_r($msg);

            die;
        }

        return $this;
    }
}
