<?php
/**
 * Created by IntelliJ IDEA.
 * User: zadil
 * Date: 30/01/19
 * Time: 09:57
 */

namespace Zadil;

use ArrayAccess;
use zadil\traits\Macroable;

class Arr
{
    use Macroable;

    /**
     * Determine whether the given value is array accessible.
     *
     * @param  mixed $value
     * @return bool
     */
    public static function accessible($value)
    {
        return is_array($value) || $value instanceof ArrayAccess;
    }


    /**
     * Collapse an array of arrays into a single array.
     *
     * @param  array $array
     * @return array
     */
    public static function collapse($array)
    {
        $results = [];
        foreach ($array as $values) {
            if ($values instanceof \JsonSerializable) {
                $values = $values->jsonSerialize();
            } elseif ($values instanceof \Traversable) {
                $values = iterator_to_array($values);
            } elseif (!is_array($values)) {
                continue;
            }
            $results = array_merge($results, $values);
        }
        return $results;
    }

    /**
     * Determine if the given key exists in the provided array.
     *
     * @param  \ArrayAccess|array $array
     * @param  string|int $key
     * @return bool
     */
    public static function exists($array, $key)
    {
        if ($array instanceof ArrayAccess) {
            return $array->offsetExists($key);
        }
        return array_key_exists($key, $array);
    }



}
