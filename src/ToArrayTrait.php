<?php

declare(strict_types=1);

namespace Polidog\ObjectToArray;

trait ToArrayTrait
{
    public function __toArray(): array
    {
        return object_to_array($this->_getProperties());
    }

    private function _getProperties(): array
    {
        return \call_user_func('get_object_vars', $this);
    }
}
