<?php
/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 13/09/15
 * Time: 21:18
 */

namespace Revinate\GetterSetter;


class GetSet implements GetSetInterface
{
    /**
     * @description Gets the value for the field $fieldName.
     * @param string $fieldName
     * @param null $default
     * @return mixed
     */
    public function getValue($fieldName, $default = null) {
        $properties = get_object_vars($this);
        if (array_key_exists($fieldName, $properties)) {
            return $this->{$fieldName};
        }
        return $default;
    }

    /**
     * @description Sets the value for the field $fieldName
     * @param string $fieldName
     * @param mixed $value
     * @return $this
     */
    public function setValue($fieldName, $value) {
        $this->{$fieldName} = $value;
        return $this;
    }
}
