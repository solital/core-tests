<?php

namespace Solital\Core\Console;

use Katrina\Katrina;

class Version
{
    const SOLITAL_VERSION = "2.0.0";
    const VINCI_VERSION = "2.0.0";

    /**
     * @return string
     */
    public static function katrinaVersion(): string
    {
        return Katrina::KATRINA_VERSION;
    }
}
