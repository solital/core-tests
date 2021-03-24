<?php

use Solital\Core\Course\Course as Course;

/**
 * Get current csrf-token
 * @return string|null
 */
function csrf_token(int $seconds = 90): ?string
{
    $baseVerifier = Course::router()->getCsrfVerifier();
    if ($baseVerifier !== null) {
        return "<input type='hidden' name='csrf_token' value='" . $baseVerifier->getTokenProvider()->setToken($seconds) . "'>";
    }

    return null;
}

/**
 * Form Method Spoofing
 * @param string $method
 * @return string
 */
function spoofing(string $method): string
{
    $method = strtoupper($method);
    return "<input type='hidden' name='_method' value='" . $method . "' readonly />";
}

/**
 * @param $value
 * @return string
 */
function pass_hash(string $value, int $cost = 10): string
{
    return password_hash($value, PASSWORD_DEFAULT, ["cost" => $cost]);
}

/**
 * @param $value
 * @param string $hash
 * @return bool
 */
function pass_verify($value, string $hash): bool
{
    if (password_verify($value, $hash)) {
        return true;
    } else {
        return false;
    }
}