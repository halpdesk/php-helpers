<?php

/**
 *  This function changes all keys in an array to camelCase style
 *
 *  @param  String      $array      The array to change
 *  @return Array                   The resulting array
 *  @author Halpdesk
 */
if (!function_exists('array_keys_to_camel_case') && function_exists('camel_case')) {
    function array_keys_to_camel_case(Array $array)
    {
        $returnArray = [];
        foreach ($array as $key => $value) {

            if (is_array($value)) {
                $returnArray[camel_case($key)] = array_keys_to_camel_case($value);
            } else {
                $returnArray[camel_case($key)] = $value;
            }
        }
        return $returnArray;
    }
}

/**
 *  This function changes all keys in an array to snake_case style
 *
 *  @param  String      $array      The array to change
 *  @return Array                   The resulting array
 *  @author Halpdesk
 */
if (!function_exists('array_keys_to_snake_case') && function_exists('snake_case')) {
    function array_keys_to_snake_case(Array $array)
    {
        $returnArray = [];
        foreach ($array as $key => $value) {

            if (is_array($value)) {
                $returnArray[snake_case($key)] = array_keys_to_snake_case($value);
            } else {
                $returnArray[snake_case($key)] = $value;
            }
        }
        return $returnArray;
    }
}

/**
 *  This function changes all keys first leter to upper case
 *
 *  @param  String      $array      The array to change
 *  @return Array                   The resulting array
 *  @author Halpdesk
 */
if (!function_exists('array_keys_to_ucfirst')) {
    function array_keys_to_ucfirst(Array $array)
    {
        $returnArray = [];
        foreach ($array as $key => $value) {

            if (is_array($value)) {
                $returnArray[ucfirst($key)] = array_keys_to_ucfirst($value);
            } else {
                $returnArray[ucfirst($key)] = $value;
            }
        }
        return $returnArray;
    }
}

/**
 *  This function changes all keys first leter to lower case
 *
 *  @param  String      $array      The array to change
 *  @return Array                   The resulting array
 *  @author Halpdesk
 */
if (!function_exists('array_keys_to_lcfirst')) {
    function array_keys_to_lcfirst(Array $array)
    {
        $returnArray = [];
        foreach ($array as $key => $value) {

            if (is_array($value)) {
                $returnArray[lcfirst($key)] = array_keys_to_lcfirst($value);
            } else {
                $returnArray[lcfirst($key)] = $value;
            }
        }
        return $returnArray;
    }
}
