<?php

declare(strict_types=1);

namespace Polidog\ObjectToArray;

/**
 * @param mixed $data
 *
 * @return mixed
 */
function object_to_array($data)
{
    if (true === \is_object($data)) {
        if (method_exists($data, '__toArray')) {
            return $data->__toArray();
        }

        $array = [];
        foreach ((array) $data as $key => $value) {
            $key = preg_replace('/\000(.*)\000/', '', $key);
            $array[$key] = object_to_array($value);
        }

        return $array;
    }

    if (true === \is_array($data)) {
        $stack = [];
        foreach ($data as $key => $value) {
            $stack[$key] = object_to_array($value);
        }

        return $stack;
    }

    return $data;
}
