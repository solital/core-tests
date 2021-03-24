<?php

use Solital\Core\Exceptions\NotFoundException;

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

NotFoundException::notFound(404, "Folder pasta", "", "HandleFiles");