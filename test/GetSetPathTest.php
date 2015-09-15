<?php
/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 13/09/15
 * Time: 18:43
 */

namespace Revinate\GetterSetter\test;

use Revinate\GetterSetter as gs;

class TestGetSetPath extends \PHPUnit_Framework_TestCase {

    public function testSetEmptyPath() {
        $uniqueObject = (object) array();

        $this->assertEquals($uniqueObject, gs\set(array(), array(), $uniqueObject));
    }


    /**
     * @covers Revinate\GetterSetter\GetSetPath::setPathValue
     * @covers Revinate\GetterSetter\GetSetPath::getPathValue
     * @covers Revinate\GetterSetter\GetSetPath::getByArrayPath
     * @covers Revinate\GetterSetter\GetSetPath::setByArrayPath
     */
    public function testGetSetPathClass() {
        $gsp = new gs\GetSetPath();

        $gsp->setPathValue('a.b.c.d', 'abcd');
        $this->assertEquals('abcd', $gsp->getPathValue('a.b.c.d'));

        $gsp->setPathValue('a.b.c.e', 'abce');
        $this->assertEquals('abcd', $gsp->getPathValue('a.b.c.d'));
        $this->assertEquals('abce', $gsp->getPathValue('a.b.c.e'));

        $gsp->setPathValue('a.a.c.d', 'aacd');
        $this->assertEquals('abcd', $gsp->getPathValue('a.b.c.d'));
        $this->assertEquals('abce', $gsp->getPathValue('a.b.c.e'));
        $this->assertEquals('aacd', $gsp->getPathValue('a.a.c.d'));

        $gsp->setByArrayPath(explode('|', 'a|a|a|d'), 'aaad');
        $this->assertEquals('abcd', $gsp->getPathValue('a.b.c.d'));
        $this->assertEquals('abce', $gsp->getPathValue('a.b.c.e'));
        $this->assertEquals('aacd', $gsp->getPathValue('a.a.c.d'));
        $this->assertEquals('aaad', $gsp->getByArrayPath(explode(',', 'a,a,a,d')));

        $gsp->setValue('b', 'b');
        $this->assertEquals('b', $gsp->getValue('b'));
    }
}
