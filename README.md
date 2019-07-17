# PHP Helper

This package provides helper functions for strings, arrays, console output and error formatting

By halpdesk, 2018-11-29

## Installation

`composer require halpdesk/helpers`

## List of Helpers

### Array helpers

```php
/**
 *  This function reads a JSON content string and converts it to an Array
 *  By Halpdesk
 *
 *  @param  String      $content    The CSV string to convert
 *  @param  Boolean     $assoc      If set to true, the function returns an object instead
 *  @throws Exception               Exception with json_last_error from json_decode if any
 *  @return mixed                   The resulting array or object
 *
 */
json_to_array(String $content, $assoc = true)
```

```php
/**
 *  Reads a JSON file and converts it to an Array
 *
 *  @param  String      $path   Full path to JSON file
 *  @return Array               The resulting array
 *  @author Halpdesk
 *
 */
json_file_to_array(String $path)
```

```php
/**
 *  Combine two arrays with same keys, last value persists
 *  ignores empty values
 *
 *  @param  Array[] $array  The arrays to patch
 *  @return Array           The resulting array
 *  @author Halpdesk
 */
array_patch(...$array)
```

```php
/**
 *  Transforms an array to CSV format
 *
 *  @param  Array $array        The arrays to transform
 *  @return string $separator   The CSV separator, typically a semicolon or comma
 *  @return string $newLine     The newline character, typically "\r\n" for windows, "\n" for linux systems
 *  @author Halpdesk
 */
array_to_csv(Array $array, String $separator = ';', String $newLine = "\n")
```

### Array key helpers

```php
/**
 *  This function changes all keys in an array to camelCase style
 *
 *  @param  String      $array      The array to change
 *  @return Array                   The resulting array
 *  @author Halpdesk
 */
array_keys_to_camel_case(Array $array)
```

```php
/**
 *  This function changes all keys in an array to snake_case style
 *
 *  @param  String      $array      The array to change
 *  @return Array                   The resulting array
 *  @author Halpdesk
 */
array_keys_to_snake_case(Array $array)
```

```php
/**
 *  This function changes all keys first leter to upper case
 *
 *  @param  String      $array      The array to change
 *  @return Array                   The resulting array
 *  @author Halpdesk
 */
array_keys_to_ucfirst(Array $array)
```

```php
/**
 *  This function changes all keys first leter to lower case
 *
 *  @param  String      $array      The array to change
 *  @return Array                   The resulting array
 *  @author Halpdesk
 */
array_keys_to_lcfirst(Array $array)
```

### Console helpers

```php
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
cc(String $string, String $fg = null, String $bg = null)
```

```php
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
eject(Array $arr, int $tabspace = 2, String $fgKeyColor = 'blue', String $fgValueColor = 'brown', $bgColor = null)
```

```php
/**
 *  edd - eject, dump and die
 *  (depends on function eject)
 *
 *  @param Array $array      The Array to dump
 *  @return void
 *  @author Halpdesk
 */
function edd(Array $array)
```

```php
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
output(String $message = null, String $style = null, int $indent = 0, bool $returnOnly = false)
```

```php
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
outputln(String $message = null, String $style = null, int $indent = 0, bool $returnOnly = false)
```

```php
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
od(String $message = null, String $style = null, int $indent = 0)
```

### Error helpers

```php
/**
 * get_formatted_trace - get the trace of an exception
 * depends on Laravel functions
 *
 * @param Array     $trace      The trace stack to format
 * @param String    $basePath   If not null, it removes the base path portion for each trace line
 * @return Array                The formatted trace
 * @author Halpdesk
 */
get_formatted_trace(Array $trace, String $basePath = null)
```

```php
/**
 *  get_formatted_error - get the error of an exception
 *
 * @param Array     $trace      The trace stack to format
 * @param String    $basePath   If not null, it removes the base path portion for each trace line
 * @param bool      $showFile   If set to true, show which file
 * @return Array                The formatted trace
 * @author Halpdesk
 */
get_formatted_error(Exception $e, String $basePath = null, bool $showFile = true)
```

### String helpers

```php
/**
 *  @param String $string   The string to camelCase
 *  @author Halpdesk
 */
camel_case(String $string)
```

```php
/**
 *  @param String $string   The string to snake_case
 *  @author Halpdesk
 */
snake_case(String $string)
```

```php
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
replace_foreign_chars(String $string)
```

```php
/**
 * Strips all letters that are not alphanumeric
 * @param String    $string     The string to manipulate
 * @return String               The stripped string
 */
strip_to_alphanumeric(String $string)
```

```php
/**
 * Checks if string is alphanumeric
 * @param String    $string     The string to manipulate
 * @return bool
 */
is_alphanumeric(String $string)
```
