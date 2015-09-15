<?php
/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 14/09/15
 * Time: 21:15
 */

namespace Revinate\GetterSetter\test;

use Revinate\GetterSetter as gs;

class TestExamples extends \PHPUnit_Framework_TestCase {
    public function testExampleJson() {
        $json = '{"name":"example","type":"json","value":22}';
        $data = json_decode($json);
        $name = gs\getValue($data, 'name');
        $missing = gs\getValue($data, 'missing');
        $this->assertEquals('example', $name);
        $this->assertNull($missing);
    }

    public function testExampleArrayVsObject() {
        $json      = '{"name":"example","type":"json","value":22}';
        $object    = json_decode($json);
        $array     = (array)$object;
        // The object gets updated as well
        $newObject = gs\setValue($object, 'type', 'Object');
        // Only the new array contains the update.
        $newArray  = gs\setValue($array, 'type', 'Array');
        $this->assertEquals($object, $newObject);
        $this->assertNotEquals($array, $newArray);
    }

    public function getEmployeeJsonData() {
        return <<<JSON
{
    "first_name" : "Joe",
    "last_name" : "Rock",
    "address" : {
        "street":"1 Main St.",
        "city":"Little Rock",
        "state":"Arkansas"
    },
    "profession":"Stone cutter"
}
JSON;

    }


    public function testExampleNesting() {
        $json = $this->getEmployeeJsonData();
        $data = json_decode($json);
        $this->assertEquals('Arkansas', gs\get($data, 'address.state'));
        $this->assertNull(gs\get($data, 'address.zip'));
    }

    public function testMagicMethods() {
        $data = new MagicAccessTestClass();
        $data->first_name = 'Joe';
        $data->last_name = 'Rock';
        gs\setValue($data, 'profession', 'Stone cutter');
        gs\setValue($data, 'address', new MagicAccessTestClass());
        gs\set($data, 'address.city', 'Little Rock');
        $this->assertEquals('Joe', gs\getValue($data, 'first_name'));
        $this->assertEquals('Rock', gs\get($data, 'last_name'));
        $this->assertEquals('Little Rock', gs\get($data, 'address.city'));
    }

}
