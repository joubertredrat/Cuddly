<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Tests\Unit\Collection\Type\Scalar;

use PHPUnit\Framework\TestCase;
use RedRat\Cuddly\Collection\Collection;
use RedRat\Cuddly\Collection\Type\Scalar\StringCollection;
use RedRat\Cuddly\Tests\Unit\Collection\ArrayEngineHelperTrait;

class StringCollectionTest extends TestCase
{
    use ArrayEngineHelperTrait;

    public function testAdd(): void
    {
        $collection = new StringCollection(
            self::getRandomArrayEngine()
        );

        self::assertTrue($collection->add('foo'));
        self::assertTrue($collection->add('foo', true));
        self::assertFalse($collection->add('foo'));
    }

    public function testHas(): void
    {
        $collection = new StringCollection(
            self::getRandomArrayEngine()
        );

        self::assertFalse($collection->has('foo'));
        self::assertFalse($collection->has('bar'));

        $collection->add('foo');

        self::assertTrue($collection->has('foo'));
    }

    public function testRemove(): void
    {
        $collection = new StringCollection(
            self::getRandomArrayEngine()
        );
        $collection->add('foo');

        self::assertTrue($collection->remove('foo'));
        self::assertFalse($collection->remove('foo'));
    }

    public function testCount(): void
    {
        $collection = new StringCollection(
            self::getRandomArrayEngine()
        );

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

        $collection = new StringCollection(
            self::getRandomArrayEngine()
        );

        foreach ($arrayExpected as $item) {
            $collection->add($item);
        }

        self::assertEquals($arrayExpected, $collection->getList());
    }

    public function testCreateArrayFixed(): void
    {
        $collection = StringCollection::create(10);
        self::assertInstanceOf(Collection::class, $collection);
        self::assertInstanceOf(StringCollection::class, $collection);
    }

    public function testCreateArraySlice(): void
    {
        $collection = StringCollection::create();
        self::assertInstanceOf(Collection::class, $collection);
        self::assertInstanceOf(StringCollection::class, $collection);
    }
}
