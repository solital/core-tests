<?php

require_once 'vendor/autoload.php';
require_once 'helpers.php';

use Solital\Core\Resource\FileSystem\HandleFolders;
use Solital\Core\Resource\FileSystem\HandleFiles;
use Solital\Core\Wolf\Minify;
use Solital\Core\Wolf\WolfMinify;

/* $array = [
    'name' => 'Solital',
    'email' => 'solital@email.com'
];

#cloner($array);
dumper($array, true);
#dump($array); */

echo '<pre>';

#WolfMinify::minifyCss();
#WolfMinify::minifyJs();
#WolfMinify::minifyAll();

$handle = new HandleFiles();
#$folder = new HandleFolders();

#$res = $handle->getAndPutContents('config.php', 'config_bkp.php');
#$handle->setPermission('config.php', 777);
#$res = $handle->getPermission('config.php');
#$res = $handle->getFullPermission('config.php');

var_dump($res);
