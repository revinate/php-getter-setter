<?php
/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 13/09/15
 * Time: 12:34
 */

namespace Revinate\GetterSetter;


interface GetSetPathInterface extends GetSetInterface
{

    /**
     * @description Gets the field value based upon the path.
     * @param array $pathToField
     * @param null|mixed $default
     * @return mixed
     */
    public function getByArrayPath($pathToField, $default = null);

    /**
     * @description Sets the field value based upon the path.
     * @param array $pathToField
     * @param mixed $value
     * @return $this
     */
    public function setByArrayPath($pathToField, $value);
}
