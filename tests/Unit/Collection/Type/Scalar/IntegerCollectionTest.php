<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Tests\Unit\Collection\Type\Scalar;

use PHPUnit\Framework\TestCase;
use RedRat\Cuddly\Collection\Collection;
use RedRat\Cuddly\Collection\Type\Scalar\IntegerCollection;
use RedRat\Cuddly\Tests\Unit\Collection\ArrayEngineHelperTrait;

class IntegerCollectionTest extends TestCase
{
    use ArrayEngineHelperTrait;

    public function testAdd(): void
    {
        $collection = new IntegerCollection(
            self::getRandomArrayEngine()
        );

        self::assertTrue($collection->add(10));
        self::assertTrue($collection->add(10, true));
        self::assertFalse($collection->add(10));
    }

    public function testHas(): void
    {
        $collection = new IntegerCollection(
            self::getRandomArrayEngine()
        );

        self::assertFalse($collection->has(10));
        self::assertFalse($collection->has(12));

        $collection->add(10);

        self::assertTrue($collection->has(10));
    }

    public function testRemove(): void
    {
        $collection = new IntegerCollection(
            self::getRandomArrayEngine()
        );
        $collection->add(10);

        self::assertTrue($collection->remove(10));
        self::assertFalse($collection->remove(10));
    }

    public function testCount(): void
    {
        $collection = new IntegerCollection(
            self::getRandomArrayEngine()
        );

        self::assertCount(0, $collection);

        $collection->add(10);
        $collection->add(12);

        self::assertCount(2, $collection);

        $collection->remove(10);
        $collection->add(14);
        $collection->add(16);

        self::assertCount(3, $collection);
    }

    public function testGetList(): void
    {
        $arrayExpected = [1, 2, 4, 8, 16, 32];

        $collection = new IntegerCollection(
            self::getRandomArrayEngine()
        );

        foreach ($arrayExpected as $item) {
            $collection->add($item);
        }

        self::assertEquals($arrayExpected, $collection->getList());
    }

    public function testCreateArrayFixed(): void
    {
        $collection = IntegerCollection::create(10);
        self::assertInstanceOf(Collection::class, $collection);
        self::assertInstanceOf(IntegerCollection::class, $collection);
    }

    public function testCreateArraySlice(): void
    {
        $collection = IntegerCollection::create();
        self::assertInstanceOf(Collection::class, $collection);
        self::assertInstanceOf(IntegerCollection::class, $collection);
    }
}
