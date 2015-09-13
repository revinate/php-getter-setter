<?php
/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 13/09/15
 * Time: 22:53
 */

namespace Revinate\GetterSetter\test;


use Revinate\GetterSetter\GetSet;

class GetSetTest extends \PHPUnit_Framework_TestCase {

    public function testGetSet() {
        $gs = new GetSet();
        $notFound = (object)array();

        $this->assertEquals($notFound, $gs->getValue('a', $notFound));

        $gs->setValue('a', 'a');
        $this->assertEquals('a', $gs->getValue('a', $notFound));

        $gs->setValue('null', null);
        $this->assertEquals(null, $gs->getValue('null', $notFound));
    }
}
