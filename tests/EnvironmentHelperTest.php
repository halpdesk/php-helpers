<?php

namespace Halpdesk\Tests;

use PHPUnit\Framework\TestCase;

/**
 * @author Daniel Leppänen
 */
class EnvironmentHelperTest extends TestCase
{
    /**
     * @covers env()
     * @group environment
     */
    public function test_env()
    {
        $value = "asdf";
        putenv("HALPDESK_TEST=".$value);
        $this->assertEquals(
            env("HALPDESK_TEST", "boom"),
            $value
        );
        $this->assertEquals(
            env("HALPDESK_TEST"),
            $value
        );
        $this->assertEquals(
            \Halpdesk\Helpers\env("NOT_FOUND", "zoom"),
            "zoom"
        );
        $this->assertNull(
            env("HALPDESK_ENV_NOT_FOUND", null)
        );
    }
}
