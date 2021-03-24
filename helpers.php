<?php

/**
 * The command below requires all helpers files that 
 * exist inside the `Helpers` folder.
 */

require_once 'vendor/autoload.php';

foreach (glob('src/Resource/Helpers/*.php') as $helpers) {
    require_once $helpers;
}
