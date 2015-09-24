<?php
/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 20/08/15
 * Time: 23:08
 */

namespace Revinate\GetterSetter\test;

use Revinate\GetterSetter as gs;

class GetFunctionsTest extends \PHPUnit_Framework_TestCase {

    /**
     * @return array
     * @codeCoverageIgnore
     */
    public function providerGetters() {
        $default = (object) array('hidden', 'value'=>'default');
        return array(
            array('isPublic',           $default, true),
            array('isProtected',        $default, true),
            array('isPrivate',          $default, true),
            array('isNotPrivate',       $default, true),
            array('isNotPublic',        $default, true),
            array('public',             $default, 'public'),
            array('protected',          $default, 'protected'),
            array('private',            $default, 'private'),
            array('nullValue',          $default, null),
            array('nullValueProtected', $default, null),
            array('methodGetterSetter', $default, 'method'),

            // non-existing but should return a value.
            array('notPrivate',         $default, true),
            array('notPublic',          $default, true),

            // test underscore
            array('is_public',              $default, true),
            array('is_protected',           $default, true),
            array('is_private',             $default, true),
            array('is_not_private',         $default, true),
            array('is_not_public',          $default, true),
            array('null_value',             $default, null),
            array('null_value_protected',   $default, null),
            array('method_getter_setter',   $default, 'method'),
            array('public_string_value',    $default, 'public_string_value'),
            array('protected_string_value', $default, 'protected_string_value'),
            array('private_string_value',   $default, 'private_string_value'),

            // non-existing, should return default
            array('notFound',                   $default, $default),
            array('methodGetterSetterValue',    $default, $default),

        );
    }

    /**
     * @param $fieldName
     * @param $default
     * @param $expectedValue
     * @dataProvider providerGetters
     *
     */
    public function testGetValue($fieldName, $default, $expectedValue) {
        $testClass = new AccessTestClass();

        $this->assertEquals($expectedValue, gs\getValue($testClass, $fieldName, $default));

        $getSetClass = new gs\GetSet();


        gs\setValue($getSetClass, 'a', new gs\GetSet());
        $this->assertInstanceOf('Revinate\GetterSetter\GetSet', gs\getValue($getSetClass, 'a'));

        $notFound = (object)array();

        $this->assertEquals($notFound, gs\getValue($getSetClass, 'b', $notFound));

        gs\setValue($getSetClass, 'b', null);
        $this->assertNull(gs\getValue($getSetClass, 'b', $notFound));
    }

    public function testGetMagic() {
        $testClass = new MagicAccessGetTestClass();

        $notFound = (object) array();
        
        $this->assertNotEquals($notFound, gs\getValue($testClass, 'a', $notFound));
        $this->assertNull(gs\getValue($testClass, 'a', $notFound));
    }

    public function testNull() {
        $notFound = (object) array();
        $this->assertEquals($notFound, gs\getValue(null, 'name', $notFound));
    }

    public function testNullFields() {
        $doc = array(
            'location' => null,
            'info' => array(
                'companyName' => null,
                'address' => null,
                'extra' => null,
            ),
        );

        $notFound = (object) array();
        $this->assertEquals($notFound, gs\get($doc, 'location.lat', $notFound));
        $this->assertNull(gs\get($doc, 'location', $notFound));
    }


}
