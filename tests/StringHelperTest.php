<?php

namespace Halpdesk\Tests;

use PHPUnit\Framework\TestCase;

/**
 * @author Daniel Leppänen
 */
class StringHelperTest extends TestCase
{
    /**
     * @covers camel_case()
     * @group string
     */
    public function test_camel_case()
    {
        $this->assertEquals(
            'helloWorld',
            \Halpdesk\Helpers\camel_case('HelloWorld')
        );
        $this->assertEquals(
            'helloWorld',
            \Halpdesk\Helpers\camel_case('Hello world')
        );
        // $this->assertEquals(
        //     'helloWorld',
        //     camel_case('Hello.World')
        // );
        $this->assertEquals(
            'helloWorld',
            \Halpdesk\Helpers\camel_case('hello-world')
        );
        $this->assertEquals(
            'helloWorld',
            \Halpdesk\Helpers\camel_case('hello_world')
        );
    }

    /**
     * @covers snake_case()
     * @group string
     */
    public function test_snake_case()
    {
        $this->assertEquals(
            'hello_world',
            snake_case('HelloWorld')
        );
        $this->assertEquals(
            'hello_world',
            snake_case('Hello world')
        );
        // $this->assertEquals(
        //     'hello_world',
        //     snake_case('Hello.World')
        // );
        $this->assertEquals(
            'hello_world',
            snake_case('hello-world')
        );
        $this->assertEquals(
            'hello_world',
            snake_case('helloWorld')
        );
    }

    /**
     * @covers replace_foreign_chars()
     * @group string
     */
    public function test_replace_foreign_chars()
    {
        $this->assertEquals(
            'ceiuuaaaeoooEIUUAAAEOOO',
            replace_foreign_chars('çéíûüåäæöõøÉÍÛÜÅÄÆÕÖØ')
        );
    }

    /**
     * @covers strip_to_alphanumeric()
     * @group string
     */
    public function test_strip_to_alphanumeric()
    {
        $this->assertEquals(
            'Im only alphanumeric I AM Bond - James Bond 007',
            strip_to_alphanumeric('I\'m ñØᄐonly alpha+numeric, I. AM. Bond - James Bond: 007')
        );
    }

    /**
     * @covers is_alphanumeric()
     * @group string
     */
    public function test_is_alphanumeric()
    {
        $this->assertTrue(is_alphanumeric('Im only alphanumeric I AM Bond - James Bond 007'));
        $this->assertFalse(is_alphanumeric('I\'m ñØᄐonly alpha+numeric, I. AM. Bond - James Bond: 007'));
    }
}
