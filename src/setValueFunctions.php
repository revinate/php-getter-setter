<?php
/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 13/09/15
 * Time: 12:59
 */

namespace Revinate\GetterSetter;


/**
 * @param array|object $doc
 * @param string       $fieldName
 * @param mixed        $value
 * @return array|\ArrayAccess
 */
function setValue($doc, $fieldName, $value) {
    if ($doc instanceof GetSetInterface) {
        return $doc->setValue($fieldName, $value);
    }
    if (is_array($doc) || $doc instanceof \ArrayAccess) {
        $doc[$fieldName] = $value;
        return $doc;
    }

    if (is_object($doc)) {
        // Does the property exist?
        $fields = get_object_vars($doc);
        if (array_key_exists($fieldName, $fields)) {
            $doc->{$fieldName} = $value;
            return $doc;
        }

        // Try __set
        if (method_exists($doc, '__set')) {
            $doc->{$fieldName} = $value;
            return $doc;
        }

        // Try using setters
        $setters = array(
            'set'.$fieldName, $fieldName,
        );
        $fieldNameNoUnderscores = str_replace('_', '', $fieldName);
        if ($fieldName != $fieldNameNoUnderscores) {
            $_setters = array('set'.$fieldNameNoUnderscores, $fieldNameNoUnderscores, );
            $setters = array_merge($setters, $_setters);
        }
        foreach ($setters as $methodName) {
            if (method_exists($doc, $methodName)) {
                $doc->{$methodName}($value);
                return $doc;
            }
        }

        // Just try it.
        $doc->{$fieldName} = $value;
        return $doc;
    }

    throw new \Exception("Unable to set field: '$fieldName'");
}


/**
 * @param array|object    $doc
 * @param string|string[] $fieldPath
 * @param mixed           $value
 * @param string          $pathSeparator
 * @return mixed the updated document
 */
function setPathValue($doc, $fieldPath, $value, $pathSeparator = '.') {
    $path = is_array($fieldPath) || ($fieldPath instanceof \ArrayAccess)
        ? $fieldPath
        : explode($pathSeparator, $fieldPath);
    return setValueByArrayPath($doc, $path, $value);
}

/**
 * @param array|object $doc
 * @param string[]     $fieldPath
 * @param mixed        $value
 * @return mixed the updated document
 */
function setValueByArrayPath($doc, $fieldPath, $value) {
    $fieldPath = (array)$fieldPath;  // Force a copy if it is an ArrayObject.
    if (empty($fieldPath)) {
        return $value;
    }
    $fieldName = array_shift($fieldPath);
    $subDoc = getValue($doc, $fieldName, array());
    $subDocUpdated = setValueByArrayPath($subDoc, $fieldPath, $value);
    return setValue($doc, $fieldName, $subDocUpdated);
}