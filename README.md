# phpGetterSetter
PHP Library for simplifying getting and setting values in arrays or objects

## Summary

At its core, this library is composed of 3 function pairs:

- `getValue` / `setValue` -- functions to get and set values in an array, object, or class.
- `getPathValue` / `setPathValue` -- Similar to `getValue` and `setValue`, but allows for dot notation field names to access nested values.
- `getValueByArrayPath` / `setValueByArrayPath` -- used by `getPathValue` and `setPathValue` to access the nested values by specifying the path in an array. 

## Instalation 
Use Composer:

```json
"require": {
    "revinate/php-getter-setter": "~0.1"
},
```

## Usage

To make things easier, include the follow use statement at the top of your files:
```php
use Revinate\GetterSetter as gs;
```

## getValue and setValue

### Getting a Value
```php
$name = gs\getValue($data, 'name');
```

### Getting a Value with a default
```php
$name = gs\getValue($data, 'count', 0);
```

### Setting a Value
```php
$updatedData = gs\setValue($data, 'count', 42);
```

Here is an example unit test to give a bit more context.
```php
public function testExampleJson() {
    $json = '{"name":"example","type":"json","value":22}';
    $data = json_decode($json);
    $name = gs\getValue($data, 'name');
    $missing = gs\getValue($data, 'missing');
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
    $newObject = gs\setValue($object, 'type', 'Object');
    // Only the new array contains the update.
    $newArray  = gs\setValue($array, 'type', 'Array');
    $this->assertEquals($object, $newObject);
    $this->assertNotEquals($array, $newArray);
}
```

## getPathValue and setPathValue

`getPathValue` and `setPathValue` provide an easy short for getting and setting nested values.  

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
$this->assertEquals('Arkansas', gs\getPathValue($data, 'address.state'));
$this->assertNull(gs\getPathValue($data, 'address.zip'));
```

The notation is longer than `$data->address->state`, but it will not blow up where this will `$data->address->zip`.

## Getters and Setters

These functions support getters, setters and magic methods use by many ORM systems like Doctrine.

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
    gs\setValue($data, 'profession', 'Stone cutter');
    gs\setValue($data, 'address', new MagicAccessTestClass());
    gs\setPathValue($data, 'address.city', 'Little Rock');
    $this->assertEquals('Joe', gs\getValue($data, 'first_name'));
    $this->assertEquals('Rock', gs\getPathValue($data, 'last_name'));
    $this->assertEquals('Little Rock', gs\getPathValue($data, 'address.city'));
}
```

