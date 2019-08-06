<?php

/**
 * get_formatted_trace - get the trace of an exception
 * depends on Laravel functions
 *
 * @param Array     $trace      The trace stack to format
 * @param String    $basePath   If not null, it removes the base path portion for each trace line
 * @return Array                The formatted trace
 * @author Halpdesk
 */
if (!function_exists('get_formatted_trace')) {
    function get_formatted_trace(Array $trace, String $basePath = null)
    {
        $basePath = $basePath ?? (function_exists('base_path') ? base_path() : dirname(realpath(__FILE__))) . DIRECTORY_SEPARATOR;

        $formattedTrace = [];

        foreach ($trace as $t) {

            if (isset($t['function'])) {
                $function = isset($t['class']) ? $t['class'] . $t['type'] . $t['function'] . "()" : $t['function'] . "()";
            } else {
                $function = '';
            }
            $file = isset($t['file']) ? str_replace($basePath . '/', '', $t['file']) : '';
            $line = isset($t['line']) ? $t['line'] : '';


            $in = (empty($file)) ? '' : ' --> ' . $file . ':' . $line . '';

            $formattedTrace[] = $function . $in;
        }

        return $formattedTrace;
    }
}

/**
 *  get_formatted_error - get the error of an exception
 *
 * @param Array     $trace      The trace stack to format
 * @param String    $basePath   If not null, it removes the base path portion for each trace line
 * @param bool      $showFile   If set to true, show which file
 * @return Array                The formatted trace
 * @author Halpdesk
 */
if (!function_exists('get_formatted_error')) {
    function get_formatted_error(Exception $e, String $basePath = null, bool $showFile = true)
    {
        $basePath = $basePath ?? (function_exists('base_path') ? base_path() : dirname(realpath(__FILE__))) . DIRECTORY_SEPARATOR;

        $file = str_replace($basePath, '', $e->getFile());
        $line = $e->getLine();
        $message = !empty(trim($e->getMessage())) ? ': ' . $e->getMessage() : ' with no message';

        $formattedError = (new \ReflectionClass($e))->getShortName() . '[' . $e->getCode() . ']' . $message .
            ($showFile ? ' --> ' . $basePath . $file . ':' . $line : '');

        return $formattedError;
    }
}
