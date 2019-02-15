<?php

namespace App\Api;

/**
 * Useful helper functions.
 */
class Api {
    /**
     * Retrieve latest tag from Git.
     */
    public static function version()
    {
        return exec('git describe --tags');
    }

    /**
     * Format: <yymmddHHiiss>.<abbreviated-commit-hash>
     */
    public static function build()
    {
        return exec('git log --format="%ad" --date=format:"%y%m%d%H%M%S" -n 1').'.'.exec('git log --format="%h" -n 1');
    }
}