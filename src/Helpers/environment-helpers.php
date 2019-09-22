<?php

/**
 *  @param String $key      The environment variable to get
 *  @param String $default  If hte environment variable is empty, return this instead
 *  @return String
 *  @author Halpdesk
 */
if (!function_exists('env')) {
    function env(String $key, String $default)
    {
        $value = getenv($key);
        return empty($value) ? $default : $value;
    }
}
