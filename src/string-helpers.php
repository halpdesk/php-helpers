<?php

namespace Halpdesk\Helpers {

    /**
     *  @param String $string   The string to camelCase
     *  @author Halpdesk
     */
    function camel_case(String $string)
    {
        $chars = ['-', '_', ' '];
        return lcfirst(str_replace($chars, '', ucwords($string, implode($chars))));
    }

    /**
     *  @param String $string   The string to snake_case
     *  @author Halpdesk
     */
    function snake_case(String $string)
    {
        $chars = ['-', ' '];
        // u = treated as UTF8
        return strtolower(str_replace($chars, '_', preg_replace('/(.)(?=[A-Z])/u', '$1_', $string)));
    }

    /**
     *  replace_foregin_chars - will return a string with foreign characters like å, ä, ö replaced with a, a, o
     *
     *  There are probably many ways to do this for all characters, but the blow answer does not work for all encodings:
     *  https://stackoverflow.com/questions/9720665/how-to-convert-special-characters-to-normal-characters
     *
     *  @param String   $string The string to manipulate
     *  @return String          The string with foreign characters replaced
     *  @author Halpdesk
     */
    function replace_foreign_chars(String $string)
    {
        $foreign = [
            'ç',
            'é', 'í', 'û', 'ü', 'å', 'ä', 'æ', 'ö', 'õ', 'ø',
            'É', 'Í', 'Û', 'Ü', 'Å', 'Ä', 'Æ', 'Õ', 'Ö', 'Ø'
        ];
        $safe = [
            'c',
            'e', 'i', 'u', 'u', 'a', 'a', 'ae', 'o', 'o', 'o',
            'E', 'I', 'U', 'U', 'A', 'A', 'AE', 'O', 'O', 'O'
        ];
        return str_replace($foreign, $safe, $string);
    }

    /**
     * Strips all letters that are not alphanumeric
     * @param String    $string     The string to manipulate
     * @return String               The stripped string
     */
    function strip_to_alphanumeric(String $string)
    {
        $string = preg_replace('/[^a-zA-Z0-9\s\-_]/i', '', $string);
        return $string;
    }

    /**
     * Checks if string is alphanumeric
     * @param String    $string     The string to manipulate
     * @return bool
     */
    function is_alphanumeric(String $string)
    {
        return preg_match('/[^a-z0-9\s\-_]/i', $string) === 0;
    }
}


namespace {

    if (!function_exists('camel_case')) {
        function camel_case(String $string) {
            return \Halpdesk\Helpers\camel_case($string);
        }
    }
    if (!function_exists('snake_case')) {
        function snake_case(String $string) {
            return \Halpdesk\Helpers\snake_case($string);
        }
    }
    if (!function_exists('replace_foreign_chars')) {
        function replace_foreign_chars(String $string) {
            return \Halpdesk\Helpers\replace_foreign_chars($string);
        }
    }
    if (!function_exists('strip_to_alphanumeric')) {
        function strip_to_alphanumeric(String $string) {
            return \Halpdesk\Helpers\strip_to_alphanumeric($string);
        }
    }
    if (!function_exists('is_alphanumeric')) {
        function is_alphanumeric(String $string) {
            return \Halpdesk\Helpers\is_alphanumeric($string);
        }
    }
}
