<?php

use Solital\Core\Console\Execute;

class VinciTest
{
    public function addCss()
    {
        $exc = new Execute();
        $res = $exc->css()->addComponent("file", "./");

        var_dump($res);
    }
}
