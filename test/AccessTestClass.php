<?php
/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 13/09/15
 * Time: 09:46
 */

namespace Revinate\GetterSetter\test;

/**
 * Class AccessTestClass
 * @package Revinate\GetterSetter\test
 * @codeCoverageIgnore
 */
class AccessTestClass {

    public    $isPublic    = true;
    protected $isProtected = true;
    private   $isPrivate   = true;

    public    $isNotPrivate = true;
    protected $isNotPublic  = true;

    public    $public    = 'public';
    protected $protected = 'protected';
    private   $private   = 'private';

    public    $nullValue          = null;
    protected $nullValueProtected = null;

    private   $methodGetterSetterValue = 'method';

    public    $public_string_value    = 'public_string_value';
    protected $protected_string_value = 'protected_string_value';
    private   $private_string_value   = 'private_string_value';

    /**
     * @return boolean
     */
    public function isPublic() {
        return $this->isPublic;
    }

    /**
     * @param boolean $isPublic
     */
    public function setIsPublic($isPublic) {
        $this->isPublic = $isPublic;
    }

    /**
     * @return boolean
     */
    public function isProtected() {
        return $this->isProtected;
    }

    /**
     * @param boolean $isProtected
     */
    public function setIsProtected($isProtected) {
        $this->isProtected = $isProtected;
    }

    /**
     * @return boolean
     */
    public function isIsPrivate() {
        return $this->isPrivate;
    }

    /**
     * @param boolean $isPrivate
     */
    public function setIsPrivate($isPrivate) {
        $this->isPrivate = $isPrivate;
    }

    /**
     * @return boolean
     */
    public function isNotPrivate() {
        return $this->isNotPrivate;
    }

    /**
     * @param boolean $isNotPrivate
     */
    public function setIsNotPrivate($isNotPrivate) {
        $this->isNotPrivate = $isNotPrivate;
    }

    /**
     * @return boolean
     */
    public function isNotPublic() {
        return $this->isNotPublic;
    }

    /**
     * @param boolean $isNotPublic
     */
    public function setIsNotPublic($isNotPublic) {
        $this->isNotPublic = $isNotPublic;
    }

    /**
     * @return string
     */
    public function getPublic() {
        return $this->public;
    }

    /**
     * @param string $public
     */
    public function setPublic($public) {
        $this->public = $public;
    }

    /**
     * @return string
     */
    public function getProtected() {
        return $this->protected;
    }

    /**
     * @param string $protected
     */
    public function setProtected($protected) {
        $this->protected = $protected;
    }

    /**
     * @return string
     */
    public function getPrivate() {
        return $this->private;
    }

    /**
     * @param string $private
     */
    public function setPrivate($private) {
        $this->private = $private;
    }

    /**
     * @return null
     */
    public function getNullValue() {
        return $this->nullValue;
    }

    /**
     * @param null $nullValue
     */
    public function setNullValue($nullValue) {
        $this->nullValue = $nullValue;
    }

    /**
     * @return null
     */
    public function getNullValueProtected() {
        return $this->nullValueProtected;
    }

    /**
     * @param null $nullValueProtected
     */
    public function setNullValueProtected($nullValueProtected) {
        $this->nullValueProtected = $nullValueProtected;
    }

    /**
     * old style getter and setting in a single method.
     */
    public function methodGetterSetter() {
        $args = func_get_args();
        if (! empty($args)) {
            $this->methodGetterSetterValue = $args[0];
        }
        return $this->methodGetterSetterValue;
    }

    /**
     * @return string
     */
    public function getProtectedStringValue() {
        return $this->protected_string_value;
    }

    /**
     * @param string $protected_string_value
     */
    public function setProtectedStringValue($protected_string_value) {
        $this->protected_string_value = $protected_string_value;
    }

    /**
     * @return string
     */
    public function getPrivateStringValue() {
        return $this->private_string_value;
    }

    /**
     * @param string $private_string_value
     */
    public function setPrivateStringValue($private_string_value) {
        $this->private_string_value = $private_string_value;
    }


}