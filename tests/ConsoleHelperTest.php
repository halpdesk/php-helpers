<?php

namespace Halpdesk\Tests;

use PHPUnit\Framework\TestCase;

/**
 * @author Daniel Leppänen
 */
class ConsoleHelperTest extends TestCase
{
    /**
     * @covers cc()
     * @group console
     */
    public function test_cc()
    {
        $this->assertEquals(
            "\033[0;36m\033[42mHello world\033[0m",
            cc('Hello world', 'cyan', 'green')
        );
        $this->assertEquals(
            "\033[43mHello world\033[0m",
            cc('Hello world', null, 'yellow')
        );
        $this->assertEquals(
            "\033[0;37mHello world\033[0m",
            cc('Hello world', 'light_gray', null)
        );
    }

    /**
     * @covers eject()
     * @group console
     */
    public function test_eject()
    {
        // Since eject prints the string directly, it must be captured by the output buffer
        ob_start();
        \Halpdesk\Helpers\eject(["foo" => "baz", "bar" => "buz"], 2, 'blue', 'brown');
        $ejectString = ob_get_contents();
        ob_end_clean();

        $this->assertEquals("  {
    \"\033[0;34mfoo\033[0m\": \"\033[0;33mbaz\033[0m\",
    \"\033[0;34mbar\033[0m\": \"\033[0;33mbuz\033[0m\"
  }",
            $ejectString
        );
    }

    /**
     * @covers edd()
     * @group console
     */
    public function test_edd()
    {
        // Since edd prints and dies directly, it must be captured by the output buffer
        ob_start();
        eject(["foo" => "baz", "bar" => "buz"], 2, 'blue', 'brown');
        $ejectString = ob_get_contents();
        ob_end_clean();

        $this->assertEquals("  {
    \"\033[0;34mfoo\033[0m\": \"\033[0;33mbaz\033[0m\",
    \"\033[0;34mbar\033[0m\": \"\033[0;33mbuz\033[0m\"
  }",
            $ejectString
        );
    }

    /**
     * @covers output()
     * @group console
     */
    public function test_output()
    {
        // Since output prints the string directly, it must be captured by the output buffer
        ob_start();
        output('Hello world', 'info');
        $outputInfoString = ob_get_contents();
        ob_clean();
        output('Hello world', 'warn');
        $outputWarnString = ob_get_contents();
        ob_clean();
        output('Hello world', 'err');
        $outputErrString = ob_get_contents();
        ob_end_clean();
        $this->assertEquals(
            "\033[0;32mHello world\033[0m",
            $outputInfoString
        );
        $this->assertEquals(
            "\033[1;31mHello world\033[0m",
            $outputWarnString
        );
        $this->assertEquals(
            "\033[1;37m\033[41mHello world\033[0m",
            $outputErrString
        );
    }

    /**
     * @covers output()
     * @group console
     */
    public function test_output_return_only()
    {
        $this->assertEquals(
            "\033[0;32mHello world\033[0m",
            output('Hello world', 'info', 0, true)
        );
        $this->assertEquals(
            "\033[1;31mHello world\033[0m",
            output('Hello world', 'warn', 0, true)
        );
        $this->assertEquals(
            "\033[1;37m\033[41mHello world\033[0m",
            output('Hello world', 'err', 0, true)
        );
    }

    /**
     * @covers outputln()
     * @group console
     */
    public function test_outputln()
    {
        // Since output prints the string directly, it must be captured by the output buffer
        ob_start();
        outputln('Hello world', 'info');
        $outputInfoString = ob_get_contents();
        ob_clean();
        outputln('Hello world', 'warn');
        $outputWarnString = ob_get_contents();
        ob_clean();
        outputln('Hello world', 'err');
        $outputErrString = ob_get_contents();
        ob_end_clean();
        $this->assertEquals(
            "\033[0;32mHello world\n\033[0m",
            $outputInfoString
        );
        $this->assertEquals(
            "\033[1;31mHello world\n\033[0m",
            $outputWarnString
        );
        $this->assertEquals(
            "\033[1;37m\033[41mHello world\n\033[0m",
            $outputErrString
        );
    }

    /**
     * @covers output()
     * @group console
     */
    public function test_outputln_return_only()
    {
        $this->assertEquals(
            "\033[0;32mHello world\n\033[0m",
            outputln('Hello world', 'info', 0, true)
        );
        $this->assertEquals(
            "\033[1;31mHello world\n\033[0m",
            outputln('Hello world', 'warn', 0, true)
        );
        $this->assertEquals(
            "\033[1;37m\033[41mHello world\n\033[0m",
            outputln('Hello world', 'err', 0, true)
        );
    }

    /**
     * @covers od()
     * @group console
     */
    public function test_od()
    {
        // Since output prints the string directly, it must be captured by the output buffer
        ob_start();
        output('Hello world', 'info');
        $outputInfoString = ob_get_contents();
        ob_clean();
        output('Hello world', 'warn');
        $outputWarnString = ob_get_contents();
        ob_clean();
        output('Hello world', 'err');
        $outputErrString = ob_get_contents();
        ob_end_clean();
        $this->assertEquals(
            "\033[0;32mHello world\033[0m",
            $outputInfoString
        );
        $this->assertEquals(
            "\033[1;31mHello world\033[0m",
            $outputWarnString
        );
        $this->assertEquals(
            "\033[1;37m\033[41mHello world\033[0m",
            $outputErrString
        );
    }
}
