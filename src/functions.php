<?php

namespace Polidog\ObjectToArray;

/**
 * @param $object
 * @return array
 */
function object_to_array($object)
{
    if (false === \is_object($object)) {
        throw new \InvalidArgumentException('not object.');
    }
    return array_map('Polidog\ObjectToArray\object_to_array_map', (array) $object);
}


function object_to_array_map($data) {
    if (true === \is_object($data)) {
        if (method_exists($data, '__toArray')) {
            return $data->__toArray();
        }

        $array = [];
        foreach ((array) $data as $key => $value) {
            $className = \get_class($data);
            $key = preg_replace('/\000(.*)\000/', '', str_replace($className, '', $key));
            $array[$key] = $value;
        }
        return $array;
    }

    if (true === \is_array($data)) {
        $stack = [];
        foreach ($data as $value) {
            $stack[] = object_to_array_map($value);
        }
        return $stack;
    }

    return $data;
}