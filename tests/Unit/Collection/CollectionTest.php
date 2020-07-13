<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Tests\Unit\Collection;

use PHPUnit\Framework\TestCase;
use RedRat\Cuddly\Collection\Collection;

class CollectionTest extends TestCase
{
    public function testAdd(): void
    {
        $collection = new Collection();

        self::assertTrue($collection->add('foo'));
        self::assertTrue($collection->add('foo', true));
        self::assertFalse($collection->add('foo'));
    }

    public function testHas(): void
    {
        $collection = new Collection();
        $collection->add('foo');

        self::assertTrue($collection->has('foo'));
        self::assertFalse($collection->has('bar'));
    }

    public function testRemove(): void
    {
        $collection = new Collection();
        $collection->add('foo');

        self::assertTrue($collection->remove('foo'));
        self::assertFalse($collection->remove('foo'));
    }

    public function testClear(): void
    {
        $collection = new Collection();

        self::assertCount(0, $collection);

        $collection->add('foo');
        $collection->add('bar');

        self::assertCount(2, $collection);

        $collection->clear();

        self::assertCount(0, $collection);
    }

    public function testCount(): void
    {
        $collection = new Collection();

        self::assertCount(0, $collection);

        $collection->add('foo');
        $collection->add('bar');

        self::assertCount(2, $collection);

        $collection->remove('foo');
        $collection->add('baz');
        $collection->add('qux');

        self::assertCount(3, $collection);
    }

    public function testGetList(): void
    {
        $arrayExpected = ['foo', 'bar', 'baz', 'qux', 'quux'];

        $collection = new Collection();

        foreach ($arrayExpected as $item) {
            $collection->add($item);
        }

        self::assertEquals($arrayExpected, $collection->getList());
    }
}
