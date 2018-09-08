<?php

namespace Polidog\ObjectToArray;


trait ToArrayTrait
{
    public function __toArray(): array
    {
        return array_map('\Polidog\ObjectToArray\object_to_array_map', $this->_getProperties());
    }

    private function _getProperties():array
    {
        return \call_user_func('get_object_vars', $this);
    }
}