<?php
/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 13/09/15
 * Time: 13:13
 */

namespace Revinate\GetterSetter;

use Revinate\GetterSetter as gs;

class GetterSetter implements GetterSetterInterface
{

    protected $pathSeparator = '.';

    /**
     * @description Gets the value for the field $fieldName.
     * @param array|object $data
     * @param string $fieldName
     * @param null $default
     * @return mixed
     * @throws UnableToGetFieldException
     */
    public function getValue($data, $fieldName, $default = null) {
        return gs\getValue($data, $fieldName, $default);
    }

    /**
     * @description Sets the value for the field $fieldName
     * @param array|object $data
     * @param string $fieldName
     * @param mixed $value
     * @return $this
     * @throws UnableToSetFieldException
     */
    public function setValue($data, $fieldName, $value) {
        return gs\setValue($data, $fieldName, $value);
    }

    /**
     * @description Gets the field value based upon the path.
     * @param array|object $data
     * @param array $pathToField
     * @param null|mixed $default
     * @return mixed
     * @throws UnableToGetFieldException
     */
    public function getValueByArrayPath($data, $pathToField, $default = null) {
        return gs\getValueByArrayPath($data, $pathToField, $default);
    }

    /**
     * @description Sets the field value based upon the path.
     * @param array|object $data
     * @param array $pathToField
     * @param mixed $value
     * @return mixed
     * @throws UnableToSetFieldException
     */
    public function setValueByArrayPath($data, $pathToField, $value) {
        return gs\setValueByArrayPath($data, $pathToField, $value);
    }

    /**
     * @description Gets the field value based upon the path.
     * @param array|object $data
     * @param string|array $pathToField
     * @param null|mixed $default
     * @param string|null $pathSeparator Optional path separator.
     * @return mixed
     * @throws UnableToGetFieldException
     */
    public function get($data, $pathToField, $default = null, $pathSeparator = null) {
        $pathSeparator = $pathSeparator ?: $this->pathSeparator;
        return gs\get($data, $pathToField, $default, $pathSeparator);
    }

    /**
     * @description Sets the field value based upon the path.
     * @param array|object $data
     * @param string|array $pathToField
     * @param mixed $value
     * @param string $pathSeparator
     * @return mixed
     * @throws UnableToSetFieldException
     */
    public function set($data, $pathToField, $value, $pathSeparator = null) {
        $pathSeparator = $pathSeparator ?: $this->pathSeparator;
        return gs\set($data, $pathToField, $value, $pathSeparator);
    }

    /**
     * @return string
     */
    public function getPathSeparator() {
        return $this->pathSeparator;
    }

    /**
     * @param string $pathSeparator
     */
    public function setPathSeparator($pathSeparator) {
        $this->pathSeparator = $pathSeparator;
    }


}
