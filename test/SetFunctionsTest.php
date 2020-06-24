<?php /** @noinspection PhpUnhandledExceptionInspection */

/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 13/09/15
 * Time: 14:11
 */

namespace Revinate\GetterSetter\test;

use PHPUnit\Framework\TestCase;
use Revinate\GetterSetter as gs;

/**
 * Class TestSetFunctions
 * @package Revinate\GetterSetter\test
 */
class SetFunctionsTest extends TestCase
{

    /**
     * @return array
     */
    public function providerSetters() {
        return [
            ['isPublic', false],
            ['isProtected', false],
            ['isPrivate', false],
            ['isNotPrivate', false],
            ['isNotPublic', false],
            ['public', 'public_set'],
            ['protected', 'protected_set'],
            ['private', 'private_set'],
            ['nullValue', 'null_set'],
            ['nullValueProtected', 'null_set'],
            ['methodGetterSetter', 'method_set'],

            // test underscore
            ['is_public', false],
            ['is_protected', false],
            ['is_private', false],
            ['is_not_private', false],
            ['is_not_public', false],
            ['null_value', 'null_set'],
            ['null_value_protected', 'null_set'],
            ['method_getter_setter', 'set_method'],
            ['public_string_value', 'set_public_string_value'],
            ['protected_string_value', 'set_protected_string_value'],
            ['private_string_value', 'set_private_string_value'],
        ];
    }

    /**
     * @param $fieldName
     * @param $value
     * @dataProvider providerSetters
     */
    public function testSetValue($fieldName, $value) {
        $testClass = new AccessTestClass();
        $notFound = (object)[];

        $this->assertEquals($testClass, gs\setValue($testClass, $fieldName, $value), "Set Field: $fieldName");
        $this->assertEquals($value, gs\getValue($testClass, $fieldName, $notFound), "Validate Set Field: $fieldName");
    }

    /**
     * @throws \Exception
     */
    public function testSetValueMagic() {
        $notFound = (object)[];
        $testClass = new MagicAccessTestClass();

        $this->assertEquals($notFound, gs\getValue($testClass, 'name', $notFound));

        $v = 'Hello';
        gs\setValue($testClass, 'name', $v);
        $this->assertEquals($v, gs\getValue($testClass, 'name', $notFound));

        // Assert Null is considered Not Found
        $v = null;
        gs\setValue($testClass, 'null', $v);
        $this->assertEquals($notFound, gs\getValue($testClass, 'null', $notFound));
    }

    public function providerNonObjects() {
        return [
            [1],
            [9.2],
            ['hello'],
            [true],
            [false],
            [
                static function () {
                }
            ],
        ];
    }

    /**
     * @param $nonObject
     * @dataProvider providerNonObjects
     * @expectedException        \Revinate\GetterSetter\UnableToSetFieldException
     */
    public function testSetNonObject($nonObject) {
        gs\setValue($nonObject, 'value', 42);
    }

    /**
     * @param $nonObject
     * @dataProvider providerSetters
     * @expectedException        \Revinate\GetterSetter\UnableToGetFieldException
     */
    public function testGetNonObject($nonObject) {
        gs\getValue($nonObject, 'value');
    }

    public function testSetNullField() {
        $doc = [
            'location' => null,
            'info' => [
                'companyName' => null,
                'address' => null,
                'extra' => null,
            ],
        ];

        $this->assertEquals(
            [
                'location' => ['lat' => 55.6, 'lon' => -0.6],
                'info' => [
                    'companyName' => null,
                    'address' => null,
                    'extra' => null,
                ],
            ],
            gs\set(gs\set($doc, 'location.lat', 55.6), 'location.lon', -0.6)
        );

        $this->assertEquals(
            [
                'location' => null,
                'info' => [
                    'companyName' => null,
                    'address' => null,
                    'extra' => [
                        'level1' => [
                            'level2' => 'level2',
                        ]
                    ],
                ],
            ],
            gs\set($doc, 'info.extra.level1.level2', 'level2')
        );
    }

    public function testSetNull() {
        $this->assertEquals(
            [
                'name' => ['first' => 'Joe']
            ],
            gs\set(null, 'name.first', 'Joe')
        );

        $this->assertEquals(
            ['name.first' => 'Joe'],
            gs\setValue(null, 'name.first', 'Joe')
        );
    }
}
