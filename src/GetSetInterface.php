<?php
/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 13/09/15
 * Time: 12:30
 */

namespace Revinate\GetterSetter;


interface GetSetInterface {

    /**
     * @description Gets the value for the field $fieldName.
     * @param string $fieldName
     * @param null   $default
     * @return mixed
     */
    public function getValue($fieldName, $default = null);

    /**
     * @description Sets the value for the field $fieldName
     * @param string $fieldName
     * @param mixed $value
     * @return $this
     */
    public function setValue($fieldName, $value);
}