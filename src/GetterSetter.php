<?php
/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 13/09/15
 * Time: 13:13
 */

namespace Revinate\GetterSetter;

use Revinate\GetterSetter as gs;

class GetterSetter implements GetterSetterInterface {
    /**
     * @description Gets the value for the field $fieldName.
     * @param array|object $data
     * @param string       $fieldName
     * @param null         $default
     * @return mixed
     */
    public function getValue($data, $fieldName, $default = null) {
        return gs\getValue($data, $fieldName, $default);
    }

    /**
     * @description Sets the value for the field $fieldName
     * @param array|object $data
     * @param string       $fieldName
     * @param mixed        $value
     * @return $this
     */
    public function setValue($data, $fieldName, $value) {
        return gs\setValue($data, $fieldName, $value);
    }

    /**
     * @description Gets the field value based upon the path.
     * @param array|object $data
     * @param array        $pathToField
     * @param null|mixed   $default
     * @return mixed
     */
    public function getValueByArrayPath($data, $pathToField, $default = null) {
        return gs\getValueByArrayPath($data, $pathToField, $default);
    }

    /**
     * @description Sets the field value based upon the path.
     * @param array|object $data
     * @param array        $pathToField
     * @param mixed        $value
     * @return mixed
     */
    public function setValueByArrayPath($data, $pathToField, $value) {
        return gs\setValueByArrayPath($data, $pathToField, $value);
    }

    /**
     * @description Gets the field value based upon the path.
     * @param array|object $data
     * @param string|array $pathToField
     * @param null|mixed   $default
     * @param string       $pathSeparator
     * @return mixed
     */
    public function getPathValue($data, $pathToField, $default = null, $pathSeparator = '.') {
        return gs\getPathValue($data, $pathToField, $default, $pathSeparator);
    }

    /**
     * @description Sets the field value based upon the path.
     * @param array|object $data
     * @param string|array $pathToField
     * @param mixed        $value
     * @param string       $pathSeparator
     * @return mixed
     */
    public function setPathValue($data, $pathToField, $value, $pathSeparator = '.') {
        return gs\setPathValue($data, $pathToField, $value, $pathSeparator);
    }
}