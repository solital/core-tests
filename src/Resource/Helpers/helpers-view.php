<?php

use Solital\Core\Wolf\Wolf;

/**
 * @param string $asset
 * 
 * @return string
 */
function loadCss(string $asset): string
{
    $css = Wolf::loadCss($asset);

    return $css;
}

/**
 * @param string $asset
 * 
 * @return string
 */
function loadJs(string $asset): string
{
    $css = Wolf::loadJs($asset);

    return $css;
}

/**
 * @param string $asset
 * 
 * @return string
 */
function loadImg(string $asset): string
{
    $css = Wolf::loadImg($asset);

    return $css;
}

/**
 * @param string $asset
 * 
 * @return string
 */
function loadFile(string $asset): string
{
    $css = Wolf::loadFile($asset);

    return $css;
}
