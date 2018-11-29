<?php

/*
 *  cc - console color
 *  Function from www.if-not-true-then-false.com
 */
if (!function_exists('cc')) {
    function cc($string, $foreground_color = null, $background_color = null, $escapeJson = false)
    {
        $escapeCharacter = $escapeJson ? "\033" : "\033";
        $foreground_colors = array(
            'black'        => '0;30','dark_gray'    => '1;30',
            'blue'         => '0;34','light_blue'   => '1;34',
            'green'        => '0;32','light_green'  => '1;32',
            'cyan'         => '0;36','light_cyan'   => '1;36',
            'red'          => '0;31','light_red'    => '1;31',
            'purple'       => '0;35','light_purple' => '1;35',
            'brown'        => '0;33','yellow'       => '1;33',
            'light_gray'   => '0;37','white'        => '1;37'
        );
        $background_colors = array(
            'black'      => '40', 'red'        => '41',
            'green'      => '42', 'yellow'     => '43',
            'blue'       => '44', 'magenta'    => '45',
            'light_gray' => '47', 'cyan'       => '46',
        );
        $colored_string = "";
        // Check if given foreground color found
        if (isset($foreground_colors[$foreground_color])) {
            $colored_string .= $escapeCharacter. "[" . $foreground_colors[$foreground_color] . "m";
        }
        // Check if given background color found
        if (isset($background_colors[$background_color])) {
            $colored_string .= $escapeCharacter . "[" . $background_colors[$background_color] . "m";
        }
        // Add string and end coloring
        $colored_string .=  $string . $escapeCharacter . "[0m";
        return $colored_string;
    }
}

/**
 *  Display an aray as a JSON in a console (with color support)
 *  (abbreviation `eject` = echo JSON encoded colored text)
 *
 *  @param  Array $arr              The arrays to eject
 *  @param  int $tabspace           Number of spaced in for indentation / tab
 *  @param  string $fgKeyColor      Text color for the array keys
 *  @param  string $fgValueColor    Text color for the array values
 *  @param  string $bgColor         Background color for output
 *  @return void
 *  @author Halpdesk
 */
if (!function_exists('eject') && function_exists('cc')) {
    function eject($arr, $tabspace = 2, $fgKeyColor = 'blue', $fgValueColor = 'brown', $bgColor = null)
    {
        if ($arr instanceof stdClass) {
            $arr = json_decode(json_encode($arr), true);;
        }
        // Anonymous recursive function
        $f = function ($array) use (&$f, $fgKeyColor, $fgValueColor, $bgColor) {
            if (!is_array($array)) {
                return;
            }
            $helper = array();
            foreach ($array as $key => $value) {
                if (!is_array($value)) {
                    $value = cc($value, $fgValueColor, $bgColor, true);
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
        for ($i = 0; $i <= $tabspace; $i++) {
            $indentation .= ' ';
        }

        $json = json_encode($coloredArr, JSON_PRETTY_PRINT);
        $json = str_replace("    ", "-tab1-tab2-tab3-tab4", $json);
        $json = str_replace("-tab1-tab2-tab3-tab4", "  ", $json);
        $json = str_replace("\n", "\n".$indentation, $json);
        $json = str_replace("\u001b", "\033", $json);
        echo $indentation. $json . "\n";
    }
}

/**
 * jdd - json dump and die (works good in console)
 *
 * @param Array $array      The Array to dump
 * @return void
 * @author Halpdesk
 */
if (!function_exists('jdd') && function_exists('eject')) {
    function jdd($array)
    {
        $array = json_decode(json_encode($array), true);
        eject($array);
        die();
    }
}

/**
 * output - prints a text with color support
 * depends on function cc
 *
 * @param string $message   The text to output
 * @param string $style     Three standard stylings to chose from: "info", "warn" or "err"
 * @param int $indent       Indentation
 * @param bool $returnOnly  If set to true the function only returns the text, but does not actually output it
 * @return string           The final message, color encoded
 * @author Halpdesk
 */
if (!function_exists('output') && function_exists('cc')) {
    function output($message = null, $style = null, $indent = 0, $returnOnly = false)
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
}

/**
 * outputln - output color coded message to a console with a new line
 * depends on output
 *
 * @param string $message   The text to output
 * @param string $style     Three standard stylings to chose from: "info", "warn" or "err"
 * @param int $indent       Indentation
 * @param bool $returnOnly  If set to true the function only returns the text, but does not actually output it
 * @return string           The final message, color encoded
 * @author Halpdesk
 */
if (!function_exists('outputln') && function_exists('output')) {
    function outputln($message = null, $style = null, $indent = 0, $returnOnly = false)
    {
        return output($message."\n", $style, $indent, $returnOnly);
    }
}

/**
 * od (overdose) - output and die
 * depends on output
 *
 * @param string $message   The text to output
 * @param string $style     Three standard stylings to chose from: "info", "warn" or "err"
 * @param int $indent       Indentation
 * @param bool $returnOnly  If set to true the function only returns the text, but does not actually output it
 * @return void
 * @author Halpdesk
 */
if (!function_exists('od') && function_exists('output')) {
    function od($message = null, $style = null, $indent = 0)
    {
        output($message, 'err', $indent);
        output("\n");
        die();
    }
}
