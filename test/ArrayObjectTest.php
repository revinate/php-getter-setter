<?php
/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 15/09/15
 * Time: 10:39
 */

namespace Revinate\GetterSetter\test;

use Revinate\GetterSetter as gs;

class ArrayObjectTest extends \PHPUnit_Framework_TestCase {

    /**
     * @return object
     */
    protected function getData() {
        return (object) array(
            'a' => array(
                'aa' => 'aa',
                'ab' => 'ab',
            ),
            'b' => array(
                'ba' => (object) array(
                    'baa' => 'baa',
                    'bab' => 'bab',
                ),
            ),
            'c' => null
        );
    }

    public function test() {
        $data = new \ArrayObject($this->getData());

        $this->assertEquals('aa', gs\get($data, 'a.aa'));
        $this->assertEquals(null, gs\get($data, 'c', 'default'));
        $this->assertEquals('default', gs\get($data, 'd', 'default'));

        gs\set($data, 'd', array(0,1,2,3,4,5));
        $this->assertEquals(4, gs\get($data, 'd.4'));
    }

}
