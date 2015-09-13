<?php
/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 13/09/15
 * Time: 22:27
 */

namespace Revinate\GetterSetter\test;


use Revinate\GetterSetter\GetterSetter;

class GetterSetterTest extends \PHPUnit_Framework_TestCase {

    /**
     * @return object
     * @codeCoverageIgnore
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
        );
    }

    public function testGetSetValue() {
        $gs = new GetterSetter();
        $dataObj = $this->getData();

        $dataObj2 = $gs->setValue($dataObj, 'c', array('ca' => 'ca'));
        $this->assertEquals($dataObj2, $dataObj);

        $gs->setPathValue($dataObj, 'a.a', 'a.a');
        $gs->setValueByArrayPath($dataObj, array('a','c'), 'a.c');
        $this->assertEquals('a.a', $gs->getPathValue($dataObj, 'a.a'));
        $this->assertEquals('a.c', $gs->getPathValue($dataObj, 'a.c'));
        $this->assertEquals(null, $gs->getValueByArrayPath($dataObj, array('a','b')));
        $this->assertEquals('ab', $gs->getValueByArrayPath($dataObj, array('a','ab')));
        $this->assertEquals('a.c', $gs->getValueByArrayPath($dataObj, array('a','c')));

        $this->assertEquals($dataObj->b, $gs->getValue($dataObj, 'b'));
    }
}
