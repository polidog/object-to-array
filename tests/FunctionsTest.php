<?php

declare(strict_types=1);

namespace Polidog\ObjectToArray\Test;

use PHPUnit\Framework\TestCase;
use function Polidog\ObjectToArray\object_to_array;

class FunctionsTest extends TestCase
{
    public function test_object_to_array(): void
    {
        $dateTime = new \DateTime('2018-01-01 00:00:00');
        $result = object_to_array($dateTime);

        $this->assertSame([
            'date' => '2018-01-01 00:00:00.000000',
            'timezone_type' => 3,
            'timezone' => 'UTC',
        ], $result);
    }

    public function test_dummyObject(): void
    {
        $object = new DummyObject('test-object');
        $object->add(new DummyTestObjectChild('child-1'));
        $object->add(new DummyTestObjectChild('child-2'));

        $result = object_to_array($object);

        $this->assertSame([
            'name' => 'test-object',
            'children' => [
                [
                    'name' => 'child-1',
                ],
                [
                    'name' => 'child-2',
                ],
            ],
        ], $result);
    }
}

class DummyObject
{
    private string $name;

    /**
     * @var DummyTestObjectChild[]
     */
    private array $children;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function add(DummyTestObjectChild $child): void
    {
        $this->children[] = $child;
    }
}

class DummyTestObjectChild
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
