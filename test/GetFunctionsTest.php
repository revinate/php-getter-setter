<?php
/** @noinspection PhpUnhandledExceptionInspection */

/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 20/08/15
 * Time: 23:08
 */

namespace Revinate\GetterSetter\test;

use PHPUnit\Framework\TestCase;
use Revinate\GetterSetter as gs;
use Revinate\GetterSetter\GetSet;

class GetFunctionsTest extends TestCase
{

    /**
     * @return array
     * @codeCoverageIgnore
     */
    public function providerGetters() {
        $default = (object)['hidden', 'value' => 'default'];
        return [
            ['isPublic', $default, true],
            ['isProtected', $default, true],
            ['isPrivate', $default, true],
            ['isNotPrivate', $default, true],
            ['isNotPublic', $default, true],
            ['public', $default, 'public'],
            ['protected', $default, 'protected'],
            ['private', $default, 'private'],
            ['nullValue', $default, null],
            ['nullValueProtected', $default, null],
            ['methodGetterSetter', $default, 'method'],

            // non-existing but should return a value.
            ['notPrivate', $default, true],
            ['notPublic', $default, true],

            // test underscore
            ['is_public', $default, true],
            ['is_protected', $default, true],
            ['is_private', $default, true],
            ['is_not_private', $default, true],
            ['is_not_public', $default, true],
            ['null_value', $default, null],
            ['null_value_protected', $default, null],
            ['method_getter_setter', $default, 'method'],
            ['public_string_value', $default, 'public_string_value'],
            ['protected_string_value', $default, 'protected_string_value'],
            ['private_string_value', $default, 'private_string_value'],

            // non-existing, should return default
            ['notFound', $default, $default],
            ['methodGetterSetterValue', $default, $default],

        ];
    }

    /**
     * @param $fieldName
     * @param $default
     * @param $expectedValue
     * @dataProvider providerGetters
     */
    public function testGetValue($fieldName, $default, $expectedValue) {
        $testClass = new AccessTestClass();

        $this->assertEquals($expectedValue, gs\getValue($testClass, $fieldName, $default));

        $getSetClass = new gs\GetSet();


        gs\setValue($getSetClass, 'a', new gs\GetSet());
        $this->assertInstanceOf(GetSet::class, gs\getValue($getSetClass, 'a'));

        $notFound = (object)[];

        $this->assertEquals($notFound, gs\getValue($getSetClass, 'b', $notFound));

        gs\setValue($getSetClass, 'b', null);
        $this->assertNull(gs\getValue($getSetClass, 'b', $notFound));
    }

    public function testGetMagic() {
        $testClass = new MagicAccessGetTestClass();

        $notFound = (object)[];

        $this->assertNotEquals($notFound, gs\getValue($testClass, 'a', $notFound));
        $this->assertNull(gs\getValue($testClass, 'a', $notFound));
    }

    public function testNull() {
        $notFound = (object)[];
        $this->assertEquals($notFound, gs\getValue(null, 'name', $notFound));
    }

    public function testNullFields() {
        $doc = [
            'location' => null,
            'info' => [
                'companyName' => null,
                'address' => null,
                'extra' => null,
            ],
        ];

        $notFound = (object)[];
        $this->assertEquals($notFound, gs\get($doc, 'location.lat', $notFound));
        $this->assertNull(gs\get($doc, 'location', $notFound));
    }


}
