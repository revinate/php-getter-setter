<?php
/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 13/09/15
 * Time: 18:02
 */

namespace Revinate\GetterSetter\test;

/**
 * Class MagicAccessTestClass
 * @package Revinate\GetterSetter\test
 */
class MagicAccessTestClass
{

    protected $values = [];

    /**
     * is utilized for reading data from inaccessible members.
     *
     * @param $name string
     * @return mixed
     * @link http://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    public function __get($name) {
        return $this->values[$name];
    }

    /**
     * is triggered by calling isset() or empty() on inaccessible members.
     *
     * @param $name string
     * @return bool
     * @link http://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    public function __isset($name) {
        return isset($this->values[$name]);
    }


    /**
     * run when writing data to inaccessible members.
     *
     * @param $name  string
     * @param $value mixed
     * @return void
     * @link http://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    public function __set($name, $value) {
        $this->values[$name] = $value;
    }

}
