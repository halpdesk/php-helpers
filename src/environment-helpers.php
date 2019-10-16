<?php

namespace Halpdesk\Helpers {

    /**
     *  @param String $key      The environment variable to get
     *  @param mixed $default   If hte environment variable is empty, return this instead
     *  @return String
     *  @author Halpdesk
     */
    function env(String $key, $default = null)
    {
        $value = getenv($key);
        return empty($value) ? $default : $value;
    }
}

namespace {

    if (!function_exists('env')) {
        function env(String $key, $default = null) {
            // Support only if function missing, but don't mess with Laravel
            if (class_exists(\Illuminate\Support\Env::class)) {
                return \Illuminate\Support\Env::get($key, $default);
            } else {
                return Halpdesk\Helpers\env($key, $default);
            }
        }
    }
}
