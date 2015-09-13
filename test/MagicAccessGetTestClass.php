<?php
/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 13/09/15
 * Time: 23:31
 */

namespace Revinate\GetterSetter\test;


class MagicAccessGetTestClass {

    protected $values = array();

    /**
     * is utilized for reading data from inaccessible members.
     *
     * @param $name string
     * @return mixed
     * @link http://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    function __get($name) {
        if (isset($this->values[$name])) {
            return $this->values[$name];
        }
        return null;
    }

    /**
     * run when writing data to inaccessible members.
     *
     * @param $name  string
     * @param $value mixed
     * @return void
     * @link http://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    function __set($name, $value) {
        $this->values[$name] = $value;
    }

}