<?php

namespace Halpdesk\Tests;

use PHPUnit\Framework\TestCase;
use Exception;

/**
 * @author Daniel Leppänen
 */
class ArrayHelperTest extends TestCase
{
    private $expectedArray = [
        "string" => "hello world",
        "integer" => 1,
        "boolean" => true,
        "object" => [
            "param" => "world",
            "anotherParam" => "anotherWorld"
        ],
        "array" => [
            1,
            2,
        ],
        "deep" => [
            [ "item" => "a", "type" => true ],
            [ "item" => "b", "type" => false ],
        ]
    ];

    private $csvArray = [
        ["foo", "hello", "world"],
        ["fuu", "hello", "world"],
        ["bar", "hello", "world"],
    ];

    /**
     * @covers json_to_array()
     * @group array
     */
    public function test_json_to_array()
    {
        $json = file_get_contents(__DIR__.'/testfiles/positive.json');
        $array = json_to_array($json);
        $this->assertEquals($array, $this->expectedArray);
    }

    /**
     * @covers json_to_array()
     * @group array
     */
    public function test_json_to_array_negative()
    {
        $json = file_get_contents(__DIR__.'/testfiles/malformed4.json');
        $exceptionThrown = false;
        try {
            $array = json_to_array($json);
        } catch (Exception $e) {
            $exceptionThrown = true;
            $this->assertEquals($e->getCode(), 4);
        }
        $this->assertTrue($exceptionThrown);
    }

    /**
     * @covers json_to_array()
     * @covers json_file_to_array()
     * @group array
     */
    public function test_json_file_to_array()
    {
        $array = json_file_to_array(__DIR__.'/testfiles/positive.json');
        $this->assertEquals($array, $this->expectedArray);
    }

    /**
     * @covers array_patch()
     * @group array
     */
    public function test_array_patch()
    {
        $array1 = [
            'param1' => 'hello',
            'param2' => 'world',
        ];
        $array2 = [
            'param2' => 'cow',
        ];
        $expected = [
            'param1' => $array1['param1'],
            'param2' => $array2['param2'],
        ];
        $array = array_patch($array1, $array2);
        $this->assertEquals($array, $expected);
    }

    /**
     * @covers array_to_csv()
     * @group array
     */
    public function test_array_to_csv()
    {
        $csv = array_to_csv($this->csvArray);
        $expected = "foo;hello;world;\n".
                    "fuu;hello;world;\n".
                    "bar;hello;world;\n";
        $this->assertEquals($csv, $expected);
    }
}
