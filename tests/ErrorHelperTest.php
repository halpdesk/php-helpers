<?php

namespace Halpdesk\Tests;

use PHPUnit\Framework\TestCase;
use Exception;

/**
 * @author Daniel Leppänen
 */
class ErrorHelperTest extends TestCase
{
    /**
     * @covers get_formatted_trace()
     * @group error
     */
    public function test_get_formatted_trace()
    {
        // Build up a function which will fail and catch it
        try {
            $arr = ['closure', 'test'];
            array_walk($arr, function(&$item, $key) {
                return $item->doesNotExist;
            });
        } catch (Exception $e) {
            $result = get_formatted_trace($e->getTrace());
        }

        $this->assertTrue(strpos($result[0], "PHPUnit\Util\ErrorHandler::handleError() -->") === 0);
        $this->assertTrue(strpos($result[1], "Halpdesk\Tests\ErrorHelperTest->Halpdesk\Tests\{closure}()") === 0);
        $this->assertTrue(strpos($result[2], "array_walk() -->") === 0);
        $this->assertTrue(strpos($result[3], "Halpdesk\Tests\ErrorHelperTest->test_get_formatted_trace() -->") === 0);
    }

    /**
     * @covers get_formatted_error()
     * @group error
     */
    public function test_get_formatted_error()
    {

        // Build up a function which will fail and catch it
        try {
            $arr = ['closure', 'test'];
            array_walk($arr, function(&$item, $key) {
                return $item->doesNotExist;
            });
        } catch (Exception $e) {
            $result = get_formatted_error($e);
        }

        $this->assertTrue(strpos($result, "Notice[8]: Trying to get property 'doesNotExist' of non-object -->") === 0);
    }
}
