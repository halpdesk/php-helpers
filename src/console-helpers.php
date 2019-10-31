<?php

namespace Halpdesk\Helpers {

    /**
     *  Console color
     *  Format text with the standard console colors
     *
     *  Foreground colors:
     *      black, blue, green, cyan, red, purple, brown, light_grey
     *      dark_grey, light_blue, light_green, light_cyan, light_red
     *      light_purple, yellow, white
     *
     *  Background colors:
     *      black, green, blue, light_grey, red, yellow, magenta, cyan
     *
     *  @param String $fg   The foreground color
     *  @param String $bg   The background color
     *  @author Halpdesk
     */
    function cc($string, String $fg = null, String $bg = null)
    {
        $escChr = "\033";
        $fgs = array(
            'black'      => '0;30', 'dark_gray'    => '1;30',
            'blue'       => '0;34', 'light_blue'   => '1;34',
            'green'      => '0;32', 'light_green'  => '1;32',
            'cyan'       => '0;36', 'light_cyan'   => '1;36',
            'red'        => '0;31', 'light_red'    => '1;31',
            'purple'     => '0;35', 'light_purple' => '1;35',
            'brown'      => '0;33', 'yellow'       => '1;33',
            'light_gray' => '0;37', 'white'        => '1;37'
        );
        $bgs = array(
            'black'      => '40', 'red'     => '41',
            'green'      => '42', 'yellow'  => '43',
            'blue'       => '44', 'magenta' => '45',
            'light_gray' => '47', 'cyan'    => '46',
        );
        return
            (isset($fgs[$fg]) ? "\033[" . $fgs[$fg] . "m" : null) .
            (isset($bgs[$bg]) ? "\033[" . $bgs[$bg] . "m" : null) .
            $string . "\033[0m";
    }

    /**
     *  Display an aray as a JSON in a console (with color support)
     *  (abbreviation `eject` = echo JSON encoded colored text)
     *
     *  @param  Array $arr              The arrays to eject
     *  @param  int $tabspace           Number of spaced in for indentation / tab
     *  @param  String $fgKeyColor      Text color for the array keys
     *  @param  String $fgValueColor    Text color for the array values
     *  @param  String $bgColor         Background color for output
     *  @return void
     *  @author Halpdesk
     */
    function eject(Array $arr, int $tabspace = 0, String $fgKeyColor = 'light_blue', String $fgValueColor = 'light_gray', $bgColor = null)
    {
        if ($arr instanceof stdClass) {
            $arr = json_decode(json_encode($arr), true);
        }
        // Anonymous recursive function
        $f = function ($array) use (&$f, $fgKeyColor, $fgValueColor, $bgColor) {
            if (!is_array($array)) {
                return;
            }
            $helper = array();
            foreach ($array as $key => $value) {
                if (!is_array($value)) {
                    $type = gettype($value);
                    if (is_numeric($value)) {
                        $temp = intval($value);
                    }
                    $value = cc($value, $fgValueColor, $bgColor, true);
                    settype($value, $type);
                    $value = $temp ?? $value;
                }
                if (!is_int($key)) {
                    $key = cc($key, $fgKeyColor, $bgColor, true);
                }
                $helper[$key] = is_array($value) ? $f($value) : $value;
            }
            return $helper;
        };
        $coloredArr = $f($arr);

        $indentation = '';
        for ($i = 0; $i < $tabspace; $i++) {
            $indentation .= ' ';
        }

        $json = json_encode($coloredArr, JSON_PRETTY_PRINT);
        $json = str_replace("    ", "\t", $json);
        $json = str_replace("\t", "  ", $json);
        $json = str_replace("\n", "\n".$indentation, $json);
        $json = str_replace("\u001b", "\033", $json);
        print $indentation. $json;
    }

    /**
     *  edd - eject, dump and die
     *  (depends on function eject)
     *
     *  @param Array $array      The Array to dump
     *  @return void
     *  @author Halpdesk
     */
    function edd(Array $array)
    {
        $array = json_decode(json_encode($array), true);
        eject($array);
        die("\n");
    }

    /**
     *  output - prints a text with color support
     *  (depends on function cc)
     *
     *  Styles:
     *      info, warn, err
     *
     *  @param string $message   The text to output
     *  @param string $style     Three standard stylings to chose from: "info", "warn" or "err"
     *  @param int $indent       Indentation
     *  @param bool $returnOnly  If set to true the function only returns the text, but does not actually output it
     *  @return string           The final message, color encoded
     *  @author Halpdesk
     */
    function output(String $message = null, String $style = null, int $indent = 0, bool $returnOnly = false)
    {
        $message = str_pad('', $indent, ' ') . $message;
        $format = null;
        switch ($style) {
            case 'info':
                $print = cc($message, 'green');
                break;
            case 'warn':
                $print = cc($message, 'light_red');
                break;
            case 'err':
                $print = cc($message, 'white', 'red');
                break;
            case (in_array($style, [
                'blue', 'brown', 'green', 'cyan',
                'yellow', 'purple', 'light_gray', 'black',
                'dark_gray', 'light_blue', 'light_green',
                'light_cyan', 'light_red', 'light_purple',
                'yellow', 'white'
                ])):
                $print = cc($message, $style);
                break;
            default:
                $print = $message;
        }
        if (!$returnOnly) {
            print $print;
        }
        return $print;
    }

    /**
     *  outputln - output color coded message to a console with a new line
     *  (depends on function output)
     *
     *  @param string $message   The text to output
     *  @param string $style     Three standard stylings to chose from: "info", "warn" or "err"
     *  @param int $indent       Indentation
     *  @param bool $returnOnly  If set to true the function only returns the text, but does not actually output it
     *  @return string           The final message, color encoded
     *  @author Halpdesk
     */
    function outputln(String $message = null, String $style = null, int $indent = 0, bool $returnOnly = false)
    {
        return output($message."\n", $style, $indent, $returnOnly);
    }

    /**
     *  od - output and die (i.e. overdose)
     *  (depends on function output)
     *
     *  @param string $message   The text to output
     *  @param string $style     Three standard stylings to chose from: "info", "warn" or "err"
     *  @param int $indent       Indentation
     *  @param bool $returnOnly  If set to true the function only returns the text, but does not actually output it
     *  @return void
     *  @author Halpdesk
     */
    function od(String $message = null, String $style = null, int $indent = 0)
    {
        output($message, 'err', $indent);
        die("\n");
    }
}

namespace {

    if (!function_exists('cc')) {
        function cc(String $string, String $fg = null, String $bg = null) {
            return Halpdesk\Helpers\cc($string, $fg, $bg);
        }
    }
    if (!function_exists('eject') && function_exists('cc')) {
        function eject(Array $arr, int $tabspace = 2, String $fgKeyColor = 'blue', String $fgValueColor = 'brown', $bgColor = null) {
            return Halpdesk\Helpers\eject($arr, $tabspace, $fgKeyColor, $fgValueColor, $bgColor);
        }
    }
    if (!function_exists('edd') && function_exists('eject')) {
        function edd(Array $array) {
            return Halpdesk\Helpers\edd($array);
        }
    }
    if (!function_exists('output') && function_exists('cc')) {
        function output(String $message = null, String $style = null, int $indent = 0, bool $returnOnly = false) {
            return Halpdesk\Helpers\output($message, $style, $indent, $returnOnly);
        }
    }
    if (!function_exists('outputln') && function_exists('output')) {
        function outputln(String $message = null, String $style = null, int $indent = 0, bool $returnOnly = false) {
            return Halpdesk\Helpers\outputln($message, $style, $indent, $returnOnly);
        }
    }
    if (!function_exists('od') && function_exists('output')) {
        function od(String $message = null, String $style = null, int $indent = 0) {
            return Halpdesk\Helpers\od($message, $style, $indent);
        }
    }
}
