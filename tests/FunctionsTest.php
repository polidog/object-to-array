<?php

namespace Polidog\ObjectToArray\Test;


use PHPUnit\Framework\TestCase;
use function Polidog\ObjectToArray\object_to_array;


class FunctionsTest extends TestCase
{
    public function test_object_to_array()
    {
        $dateTime = new \DateTime('2018-01-01 00:00:00');
        $result = object_to_array($dateTime);

        $this->assertSame([
            'date' => '2018-01-01 00:00:00.000000',
            'timezone_type' => 3,
            'timezone' => 'UTC'
        ], $result);
    }
}


