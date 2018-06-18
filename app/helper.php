<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('fauth')) {

    function fauth()
    {
        return Auth::guard("frontend");
    }
}

/**
 *
 */
if (!function_exists('getParserPath')) {

    function getParserPath()
    {
        return base_path('bin/parser/production.js');
    }
}
