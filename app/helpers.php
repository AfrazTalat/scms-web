<?php

use App\Support\Http\HttpResponse;

if (!function_exists('res')) {
    /**
     * Return an optional HTTP response with the success or error methods.
     *
     * @return \App\Support\Http\HttpResponse
     */
    function res()
    {
        return new HttpResponse();
    }
}

if (!function_exists('booleanish')) {
    /**
     * Finds the unique values of two arrays and return them as an array
     *
     * @return array
     */
    function booleanish($value)
    {
        if ($value === false || $value === "false" || $value === 0 || $value === "0" || $value === "" || $value === null || $value < 0) {
            return false;
        }
        return true;
    }
}
