# phpGetterSetter
PHP Library for simplifying getting and setting values in arrays or objects

## Summary

At its core, this library is composed of 3 function pairs:

- `get` / `set` -- functions to get and set nested values in an array, object, or class given a field name using dot notation
- `getValue` / `setValue` -- functions to get and set values in an array, object, or class.
- `getValueByArrayPath` / `setValueByArrayPath` -- used by `get` and `set` to access the nested values by specifying the path in an array. 

## Instalation 
Use Composer:

```json
"require": {
    "revinate/php-getter-setter": "~0.2"
},
```

## Usage

To make things easier, include the follow use statement at the top of your files:
```php
use Revinate\GetterSetter as gs;
```

## get and set

### Getting a Value
```php
$name = gs\get($data, 'name');
```

### Getting a Value with a default
```php
$name = gs\get($data, 'count', 0);
```

### Setting a Value
```php
$updatedData = gs\set($data, 'count', 42);
```

Here is an example unit test to give a bit more context.
```php
public function testExampleJson() {
    $json = '{"name":"example","type":"json","value":22}';
    $data = json_decode($json);
    $name = gs\get($data, 'name');
    $missing = gs\get($data, 'missing');
    $this->assertEquals('example', $name);
    $this->assertNull($missing);
}
```

### Differences between objects and arrays
With `setValue`, an object will get updated when a field value is set.  But it is different with arrays because they are immutable.  Only the array returned from `setValue` will have the updated fields.  Watch out for `ArrayObjects`, they will get updated just like normal `object`s.

Example Unit Test showing difference between objects and arrays:
```php
public function testExampleArrayVsObject() {
    $json      = '{"name":"example","type":"json","value":22}';
    $object    = json_decode($json);
    $array     = (array)$object;
    // The object gets updated as well
    $newObject = gs\set($object, 'type', 'Object');
    // Only the new array contains the update.
    $newArray  = gs\set($array, 'type', 'Array');
    $this->assertEquals($object, $newObject);
    $this->assertNotEquals($array, $newArray);
}
```

## Getting and Setting Nested Values

`getPathValue` and `setPathValue` provide an easy shortcut for getting and setting nested values.  

```json
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
```

Example accessing:
```php
$json = $this->getEmployeeJsonData();
$data = json_decode($json);
$this->assertEquals('Arkansas', gs\get($data, 'address.state'));
$this->assertNull(gs\get($data, 'address.zip'));
```

The notation is longer than `$data->address->state`, but it will not blow up where this will: `$data->address->zip`.

## Support for Getters, Setters, Has'ers, and Is'ers.


These functions support getters, setters and magic methods use by many ORM systems like Doctrine.

## Support for Magic methods like __get and __set


Example Data Class
```php
class MagicAccessTestClass {

    protected $values = array();

    function __get($name) {
        return $this->values[$name];
    }
    function __isset($name) {
        return isset($this->values[$name]);
    }
    function __set($name, $value) {
        $this->values[$name] = $value;
    }
}
```

Sample Usage:

```php
public function testMagicMethods() {
    $data = new MagicAccessTestClass();
    $data->first_name = 'Joe';
    $data->last_name = 'Rock';
    gs\set($data, 'profession', 'Stone cutter');
    gs\set($data, 'address', new MagicAccessTestClass());
    gs\setPathValue($data, 'address.city', 'Little Rock');
    $this->assertEquals('Joe', gs\get($data, 'first_name'));
    $this->assertEquals('Rock', gs\get($data, 'last_name'));
    $this->assertEquals('Little Rock', gs\get($data, 'address.city'));
}
```

