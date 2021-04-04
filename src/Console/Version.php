<?php

namespace Solital\Core\Console;

use Katrina\Katrina;

class Version
{
    const SOLITAL_VERSION = "2.0.0-beta4";
    const VINCI_VERSION = "2.0.0-beta";

    /**
     * @return string
     */
    public static function katrinaVersion(): string
    {
        return Katrina::KATRINA_VERSION;
    }
}
