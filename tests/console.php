<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once __DIR__ . '/vendor/autoload.php';

use Solital\Core\Console\Command\CustomCommand;

function register()
{
    $res = (new CustomCommand())->registerComponent('test', 'desc test');

    var_dump($res);
}
