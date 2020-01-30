<?php
/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 14/09/15
 * Time: 23:17
 */

namespace Revinate\GetterSetter\util;

/**
 * @description convert underscore names into camel case.  But it won't work very will with multi-byte characters.
 * @param string $string
 * @return string
 */
function toCamelCase($string) {
    return strtr(ucwords(strtr($string, ['_' => ' '])), [' ' => '']);
}
