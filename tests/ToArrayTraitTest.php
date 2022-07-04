<?php

declare(strict_types=1);

namespace Polidog\ObjectToArray\Test;

use PHPUnit\Framework\TestCase;
use Polidog\ObjectToArray\ToArrayTrait;

class ToArrayTraitTest extends TestCase
{
    public function testRun(): void
    {
        $testObject = new TestObject('test');
        $this->assertSame([
            'name' => 'test',
            'children' => [],
        ], $testObject->__toArray());
    }

    public function testNestedObject(): void
    {
        $testObject = new TestObject('test');
        $testObject->addChild(new TestObjectChild('child1'));
        $testObject->addChild(new TestObjectChild('child2'));

        $this->assertSame([
            'name' => 'test',
            'children' => [
                [
                    'name' => 'child1',
                ],
                [
                    'name' => 'child2',
                ],
            ],
        ], $testObject->__toArray());
    }

    public function testMultiNestedObject(): void
    {
        $testObject = new TestObject('test');
        $child1 = new TestObjectChildSecond('child1');
        $child2 = new TestObjectChildSecond('child2');

        $testObject->addChild($child1);
        $testObject->addChild($child2);

        $child1->add(new TestObjectChild('child1-child1'));
        $child1->add(new TestObjectChild('child1-child2'));

        $child2->add(new TestObjectChild('child2-child1'));
        $child2->add(new TestObjectChild('child2-child2'));

        $this->assertSame([
            'name' => 'test',
            'children' => [
                [
                    'name' => 'child1',
                    'children' => [
                        [
                            'name' => 'child1-child1',
                        ],
                        [
                            'name' => 'child1-child2',
                        ],
                    ],
                ],
                [
                    'name' => 'child2',
                    'children' => [
                        [
                            'name' => 'child2-child1',
                        ],
                        [
                            'name' => 'child2-child2',
                        ],
                    ],
                ],
            ],
        ], $testObject->__toArray());
    }
}

class TestObject
{
    use ToArrayTrait;

    /**
     * @var string
     */
    private $name;

    /**
     * @var TestObjectChildInterface[]
     */
    private $children = [];

    /**
     * TestObject constructor.
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function addChild(TestObjectChildInterface $child): void
    {
        $this->children[] = $child;
    }
}

interface TestObjectChildInterface
{
}

class TestObjectChild implements TestObjectChildInterface
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}

class TestObjectChildSecond implements TestObjectChildInterface
{
    use ToArrayTrait;

    private string $name;

    /**
     * @var TestObjectChildInterface[]
     */
    private array $children = [];

    /**
     * TestObjectChildSecond constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function add(TestObjectChildInterface $child): void
    {
        $this->children[] = $child;
    }
}
