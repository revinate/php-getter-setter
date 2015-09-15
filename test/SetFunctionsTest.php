<?php
/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 13/09/15
 * Time: 14:11
 */

namespace Revinate\GetterSetter\test;

use Revinate\GetterSetter as gs;

/**
 * Class TestSetFunctions
 * @package Revinate\GetterSetter\test
 */
class SetFunctionsTest extends \PHPUnit_Framework_TestCase {

    /**
     * @return array
     */
    public function providerSetters() {
        return array(
            array('isPublic',           false),
            array('isProtected',        false),
            array('isPrivate',          false),
            array('isNotPrivate',       false),
            array('isNotPublic',        false),
            array('public',             'public_set'),
            array('protected',          'protected_set'),
            array('private',            'private_set'),
            array('nullValue',          'null_set'),
            array('nullValueProtected', 'null_set'),
            array('methodGetterSetter', 'method_set'),

            // test underscore
            array('is_public',              false),
            array('is_protected',           false),
            array('is_private',             false),
            array('is_not_private',         false),
            array('is_not_public',          false),
            array('null_value',             'null_set'),
            array('null_value_protected',   'null_set'),
            array('method_getter_setter',   'set_method'),
            array('public_string_value',    'set_public_string_value'),
            array('protected_string_value', 'set_protected_string_value'),
            array('private_string_value',   'set_private_string_value'),
        );
    }

    /**
     * @param $fieldName
     * @param $value
     * @dataProvider providerSetters
     * @covers ::Revinate\GetterSetter\setValue
     * @covers ::Revinate\GetterSetter\getValue
     *
     */
    public function testSetValue($fieldName, $value) {
        $testClass = new AccessTestClass();
        $notFound = (object) array();

        $this->assertEquals($testClass, gs\setValue($testClass, $fieldName, $value), "Set Field: $fieldName");
        $this->assertEquals($value, gs\getValue($testClass, $fieldName, $notFound),  "Validate Set Field: $fieldName");
    }

    /**
     * @throws \Exception
     * @covers ::Revinate\GetterSetter\setValue
     * @covers ::Revinate\GetterSetter\getValue
     */
    public function testSetValueMagic() {
        $notFound = (object) array();
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
        array(
            array(1),
            array(9.2),
            array('hello'),
            array(null),
            array(function(){}),
        );
    }

    /**
     * @dataProvider providerSetters
     * @expectedException        Revinate\GetterSetter\UnableToSetFieldException
     */
    public function testSetNonObject($nonObject) {
        gs\setValue($nonObject, 'value', 42);
    }

    /**
     * @dataProvider providerSetters
     * @expectedException        Revinate\GetterSetter\UnableToGetFieldException
     */
    public function testGetNonObject($nonObject) {
        gs\getValue($nonObject, 'value');
    }

}
