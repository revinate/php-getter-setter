<?php /** @noinspection PhpUnhandledExceptionInspection */

/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 13/09/15
 * Time: 18:43
 */

namespace Revinate\GetterSetter\test;

use PHPUnit\Framework\TestCase;
use Revinate\GetterSetter as gs;

class GetSetPathTest extends TestCase
{

    public function testSetEmptyPath() {
        $uniqueObject = (object)[];

        $this->assertEquals($uniqueObject, gs\set([], [], $uniqueObject));
    }

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
