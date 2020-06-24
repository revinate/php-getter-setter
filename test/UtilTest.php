<?php
/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 14/09/15
 * Time: 23:40
 */

namespace Revinate\GetterSetter\test;

use PHPUnit\Framework\TestCase;
use Revinate\GetterSetter\util;

class UtilTest extends TestCase
{

    public function providerTestCamel() {
        return [
            ['FirstLetter', 'firstLetter'],
            ['HelloThere', 'hello_there'],
            ['NiceDay', 'nice day'],
        ];
    }

    /**
     * @param $expected
     * @param $value
     * @dataProvider providerTestCamel
     */
    public function testCamel($expected, $value) {
        $this->assertEquals($expected, util\toCamelCase($value));
    }
}
