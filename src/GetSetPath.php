<?php
/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 13/09/15
 * Time: 21:21
 */

namespace Revinate\GetterSetter;

class GetSetPath extends GetSet implements GetSetPathInterface {

    /**
     * @param string|string[] $pathToField
     * @param mixed|null      $default
     * @param string          $pathSeparator
     * @return mixed
     */
    public function getPathValue($pathToField, $default = null, $pathSeparator = '.') {
        return get($this, $pathToField, $default, $pathSeparator);
    }

    /**
     * @param string|string[] $pathToField
     * @param mixed           $value
     * @param string          $pathSeparator
     * @return mixed
     */
    public function setPathValue($pathToField, $value, $pathSeparator = '.') {
        return set($this, $pathToField, $value, $pathSeparator);
    }

    /**
     * @description Gets the field value based upon the path.
     * @param array      $pathToField
     * @param null|mixed $default
     * @return mixed
     */
    public function getByArrayPath($pathToField, $default = null) {
        return getValueByArrayPath($this, $pathToField, $default);
    }

    /**
     * @description Sets the field value based upon the path.
     * @param array $pathToField
     * @param mixed $value
     * @return $this
     */
    public function setByArrayPath($pathToField, $value) {
        return setValueByArrayPath($this, $pathToField, $value);
    }

}