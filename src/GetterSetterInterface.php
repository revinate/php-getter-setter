<?php
/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 13/09/15
 * Time: 13:14
 */

namespace Revinate\GetterSetter;


interface GetterSetterInterface {
    /**
     * @description Gets the value for the field $fieldName.
     * @param array|object $data
     * @param string       $fieldName
     * @param null         $default
     * @return mixed
     */
    public function getValue($data, $fieldName, $default = null);

    /**
     * @description Sets the value for the field $fieldName
     * @param array|object $data
     * @param string       $fieldName
     * @param mixed        $value
     * @return mixed - the updated $data array or object.
     */
    public function setValue($data, $fieldName, $value);

    /**
     * @description Gets the field value based upon the path.
     * @param array|object $data
     * @param array        $pathToField
     * @param null|mixed   $default
     * @return mixed
     */
    public function getValueByArrayPath($data, $pathToField, $default = null);

    /**
     * @description Sets the field value based upon the path.
     * @param array|object $data
     * @param array        $pathToField
     * @param mixed        $value
     */
    public function setValueByArrayPath($data, $pathToField, $value);

    /**
     * @description Gets the field value based upon the path.
     * @param array|object $data
     * @param string|array $pathToField
     * @param null|mixed   $default
     * @param string $pathSeparator
     * @return mixed - the updated $data array or object.
     */
    public function get($data, $pathToField, $default = null, $pathSeparator = '.');

    /**
     * @description Sets the field value based upon the path.
     * @param array|object $data
     * @param string|array $pathToField
     * @param mixed   $value
     * @param string $pathSeparator
     * @return mixed - the updated $data array or object.
     */
    public function set($data, $pathToField, $value, $pathSeparator = '.');
}