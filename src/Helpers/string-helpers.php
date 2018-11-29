<?php

/**
 *  replace_foregin_chars - will return a string with foreign characters like å, ä, ö replaced with a, a, o
 *
 *  There are probably many ways to do this for all characters, but the blow answer does not work for all encodings:
 *  https://stackoverflow.com/questions/9720665/how-to-convert-special-characters-to-normal-characters
 *
 *  @param String $string   The string to manipulate
 *  @author Halpdesk
 */
if (!function_exists('replace_foreign_chars')) {
    function replace_foreign_chars(string $string)
    {

        $foreign = ['ç', 'é', 'í', 'û', 'ü', 'å', 'ä', 'æ', 'ö', 'õ', 'ø'];
        $safe    = ['c', 'e', 'i', 'u', 'u', 'a', 'a', 'ae', 'o', 'o', 'o'];

        $foreignUpper = ['É', 'Í', 'Û', 'Ü', 'Å', 'Ä', 'Æ', 'Õ', 'Ö', 'Ø'];
        $safeUpper    = ['E', 'I', 'U', 'U', 'A', 'A', 'AE', 'O', 'O', 'O'];

        $safeString = str_replace(
            array_merge($foreign, $foreignUpper),
            array_merge($safe, $safeUpper),
            $string
        );

        return $safeString;
    }
}

/**
 * Strips all letters that are not alphanumeric
 * @param string $string    The string to manipulate
 * @return string           The stripped string
 */
if (!function_exists('convert_to_alphanumeric')) {
    function convert_to_alphanumeric($string)
    {
        $string = preg_replace('/[^a-z0-9\s-_]/i', '', $string);
        return $string;
    }
}

/**
 * Checks if string is alphanumeric
 * @return bool
 */
if (!function_exists('is_alphanumeric')) {
    function is_alphanumeric($string)
    {
        return preg_match('/[^a-z0-9\s-_]/i', $string) === 0;
    }
}
