<?php

namespace Solital\Core\Wolf;

abstract class WolfCache
{
    /**
     * @var string
     */
    protected static $file_cache;

    /**
     * @var string
     */
    protected static $cache_dir;

    /**
     * @var date
     */
    protected static $time;

    /**
     * @return string
     */
    public static function getFolderCache()
    {
        self::$cache_dir = dirname(__DIR__, 5) . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "Storage" . DIRECTORY_SEPARATOR . "cache" . DIRECTORY_SEPARATOR . "wolf" . DIRECTORY_SEPARATOR;

        return self::$cache_dir;
    }

    /**
     * @param date $time
     */
    public static function cache($time)
    {
        self::$time = $time;

        return self::$time;
    }
}
