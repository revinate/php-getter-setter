<?php /** @noinspection PhpUnhandledExceptionInspection */

/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 13/09/15
 * Time: 22:27
 */

namespace Revinate\GetterSetter\test;


use PHPUnit\Framework\TestCase;
use Revinate\GetterSetter\GetterSetter;

class GetterSetterTest extends TestCase
{

    /**
     * @return object
     * @codeCoverageIgnore
     */
    protected function getData() {
        return (object)[
            'a' => [
                'aa' => 'aa',
                'ab' => 'ab',
            ],
            'b' => [
                'ba' => (object)[
                    'baa' => 'baa',
                    'bab' => 'bab',
                ],
            ],
        ];
    }

    public function testGetSetValue() {
        $gs = new GetterSetter();
        $dataObj = $this->getData();

        $dataObj2 = $gs->setValue($dataObj, 'c', ['ca' => 'ca']);
        $this->assertEquals($dataObj2, $dataObj);

        $gs->set($dataObj, 'a.a', 'a.a');
        $gs->setValueByArrayPath($dataObj, ['a', 'c'], 'a.c');
        $this->assertEquals('a.a', $gs->get($dataObj, 'a.a'));
        $this->assertEquals('a.c', $gs->get($dataObj, 'a.c'));
        $this->assertEquals(null, $gs->getValueByArrayPath($dataObj, ['a', 'b']));
        $this->assertEquals('ab', $gs->getValueByArrayPath($dataObj, ['a', 'ab']));
        $this->assertEquals('a.c', $gs->getValueByArrayPath($dataObj, ['a', 'c']));

        $this->assertEquals($dataObj->b, $gs->getValue($dataObj, 'b'));
    }

    public function testSeparator() {
        $gs = new GetterSetter();
        $dataObject = $this->getData();

        $this->assertEquals('.', $gs->getPathSeparator());
        $gs->setPathSeparator('/');
        $this->assertEquals('/', $gs->getPathSeparator());
        $this->assertEquals('baa', $gs->get($dataObject, 'b/ba/baa'));
        $gs->set($dataObject, 'b/b/b', 'b.b.b');
        $gs->setPathSeparator('|');
        $this->assertEquals('b.b.b', $gs->get($dataObject, 'b|b|b'));
        $this->assertEquals('b.b.b', $gs->get($dataObject, 'b,b,b', null, ','));
        $gs->set($dataObject, 'b+a+c', 'b.a.c', '+');
        $this->assertEquals('b.a.c', $gs->get($dataObject, 'b|a|c'));
    }


}
