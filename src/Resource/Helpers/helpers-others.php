<?php

use Solital\Core\Resource\Session;

/**
 * Remove all get param
 * @return void
 */
function remove_param(): void
{
    $http = 'http://';

    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        $http = 'https://';
    }

    $url = $http . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    $url = parse_url($url);

    if (isset($url['query'])) {
        if (strpos($_SERVER["HTTP_HOST"], "localhost") !== false) {
            header('Refresh: 0, url =' . $url['scheme'] . "://" . $_SERVER["HTTP_HOST"] . $url['path']);
            die;
        } else {
            if (isset($url['path'])) {
                header('Refresh: 0, url =' . $url['scheme'] . "://" . $url['host'] . $url['path']);
                die;
            } else {
                header('Refresh: 0, url =' . $url['scheme'] . "://" . $url['host']);
                die;
            }
        }
    }
}

/**
 * @param mixed $string
 * 
 * @return bool
 */
function is_json($string): bool
{
    $response = false;

    if (
        is_string($string) &&
        ($string = trim($string)) &&
        ($stringLength = strlen($string)) &&
        (
            (stripos($string, '{') === 0 &&
                (stripos($string, '}', -1) + 1) === $stringLength) ||
            (stripos($string, '[{') === 0 &&
                (stripos($string, '}]', -1) + 2) === $stringLength)) &&
        ($decodedString = json_decode($string, true)) &&
        is_array($decodedString)
    ) {
        $response = true;
    }

    return $response;
}

/**
 * Get atual url
 * @return string
 */
function get_url(string $uri = null): string
{
    $http = 'http://';
    if (isset($_SERVER['HTTPS'])) {
        $http = 'https://';
    }
    $url = $http . $_SERVER['HTTP_HOST'];

    if (isset($uri)) {
        $url = $http . $_SERVER['HTTP_HOST'] . "/" . $uri;
    }

    return $url;
}

/**
 * @param string $key
 * @param int $limit = 5
 * @param int $seconds = 60
 * @return bool
 */
function request_limit(string $key, int $limit = 5, int $seconds = 60) : bool
{
    if (Session::has($key) && $_SESSION[$key]->time >= time() && $_SESSION[$key]->requests < $limit) {
        Session::new($key, [
            'time' => time() + $seconds,
            'requests' => $_SESSION[$key]->requests + 1
        ]);

        return false;
    }

    if (Session::has($key) && $_SESSION[$key]->time >= time() && $_SESSION[$key]->requests >= $limit) {
        return true;
    }

    Session::new($key, [
        'time' => time() + $seconds,
        'requests' => 1
    ]);

    return false;
}

/**
 * request_repeat
 *
 * @param string $field
 * @param string $value
 * @return bool
 */
function request_repeat(string $field, string $value): bool
{
    if (Session::has($field) && Session::show($field) == $value) {
        return true;
    }

    Session::new($field, $value);
    return false;
}