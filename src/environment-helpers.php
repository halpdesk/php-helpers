<?php

namespace Halpdesk\Helpers {

    /**
     *  @param String $key      The environment variable to get
     *  @param String $default  If hte environment variable is empty, return this instead
     *  @return String
     *  @author Halpdesk
     */
    function env(String $key, String $default = "")
    {
        $value = getenv($key);
        return empty($value) ? $default : $value;
    }
}

namespace {

    if (!function_exists('env')) {
        function env(String $key, String $default = "") {
            return Halpdesk\Helpers\env($key, $default);
        }
    }
}
