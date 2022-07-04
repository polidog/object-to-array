<?php

declare(strict_types=1);

namespace Polidog\ObjectToArray;

trait ToArrayTrait
{
    public function __toArray(bool $strict = true): array
    {
        $properties = [];
        foreach ($this->_getProperties($strict) as $key => $value) {
            $properties[underscore($key)] = $value;
        }

        return object_to_array($properties);
    }

    private function _getProperties(bool $strict): array
    {
        $properties = get_object_vars($this);

        if (false === $strict) {
            return $properties;
        }

        foreach ($properties as $key => $item) {
            if (false === property_exists(\get_class($this), $key)) {
                unset($properties[$key]);
            }
        }

        return $properties;
    }
}
