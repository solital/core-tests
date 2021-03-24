<?php

namespace Solital\Core\Console\Command;

use Solital\CustomConsole;
use Solital\Core\Database\ORMConsole;

trait CustomCommandTrait
{
    /**
     * @param array $array
     * @param string $cmd
     * 
     * @return mixed
     */
    public function prepare(array $array, string $cmd)
    {
        if (array_key_exists($cmd, $array)) {
            $method = $array[$cmd];

            if (strpos($cmd, 'katrina') === false) {
                (new CustomConsole())->$method();
            } else {
                (new ORMConsole())->$method();
            }

            $msg = $this->color->stringColor("Command successfully executed!", "green", null, true);
            print_r($msg);

        } else {
            return null;
        }

        die;
    }

    /**
     * @param string $cmd
     * 
     * @return mixed
     */
    public function execCommand(string $cmd)
    {
        if (strpos($cmd, 'katrina') === false) {
            $res = (new CustomConsole())->execute();
        } else {
            $res = (new ORMConsole())->execute();
        }

        if (is_array($res)) {
            $this->prepare($res, $cmd);
        } else {
            return null;
        }

        return $this;
    }

    /* /**
     * @param string $cmd
     * @param string $desc
     * 
     * @return CustomCommand
     *
    public function registerComponent(string $cmd, string $desc): CustomCommand
    {
        $res = $this->register()->componentsRegistered($cmd, $desc);

        var_dump($res);

        return $this;
    }

    /**
     * @param string $cmd
     * @param string $desc
     * 
     * @return CustomCommand
     *
    public function registerCommand(string $cmd, string $desc): CustomCommand
    {
        $this->register()->commandsRegistered($cmd, $desc);

        return $this;
    } */
}
