<?php

declare(strict_types=1);

namespace Polidog\ObjectToArray;

trait ToArrayTrait
{
    public function __toArray(bool $strict = true): array
    {
        return object_to_array($this->_getProperties($strict));
    }

    private function _getProperties(bool $strict): array
    {
        $properties = \call_user_func('get_object_vars', $this);
        if (false === $strict) {
            return $properties;
        }

        foreach ($properties as $key => $item) {
            if (false === property_exists(\get_class($this), $key)) {
                unset($properties[underscore($key)]);
            }
        }

        return $properties;
    }
}
