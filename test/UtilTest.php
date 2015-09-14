<?php
/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 14/09/15
 * Time: 23:40
 */

namespace Revinate\GetterSetter\test;

use Revinate\GetterSetter\util as util;

class UtilTest extends \PHPUnit_Framework_TestCase {

    public function providerTestCamel() {
        return array(
            array('FirstLetter', 'firstLetter'),
            array('HelloThere', 'hello_there'),
            array('NiceDay', 'nice day'),
        );
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
