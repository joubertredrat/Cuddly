<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Tests\Unit\Collection\Type\Scalar;

use PHPUnit\Framework\TestCase;
use RedRat\Cuddly\Collection\Collection;
use RedRat\Cuddly\Collection\Type\Scalar\FloatCollection;
use RedRat\Cuddly\Tests\Unit\Collection\ArrayEngineHelperTrait;

class FloatCollectionTest extends TestCase
{
    use ArrayEngineHelperTrait;

    public function testAdd(): void
    {
        $collection = new FloatCollection(
            self::getRandomArrayEngine()
        );

        self::assertTrue($collection->add(10.5));
        self::assertTrue($collection->add(10.5, true));
        self::assertFalse($collection->add(10.5));
    }

    public function testHas(): void
    {
        $collection = new FloatCollection(
            self::getRandomArrayEngine()
        );

        self::assertFalse($collection->has(10.5));
        self::assertFalse($collection->has(12.5));

        $collection->add(10.5);

        self::assertTrue($collection->has(10.5));
    }

    public function testRemove(): void
    {
        $collection = new FloatCollection(
            self::getRandomArrayEngine()
        );
        $collection->add(10.5);

        self::assertTrue($collection->remove(10.5));
        self::assertFalse($collection->remove(10.5));
    }

    public function testCount(): void
    {
        $collection = new FloatCollection(
            self::getRandomArrayEngine()
        );

        self::assertCount(0, $collection);

        $collection->add(10.5);
        $collection->add(12.5);

        self::assertCount(2, $collection);

        $collection->remove(10.5);
        $collection->add(14.5);
        $collection->add(16.5);

        self::assertCount(3, $collection);
    }

    public function testGetList(): void
    {
        $arrayExpected = [1.5, 2.5, 4.5, 8.5, 16.5, 32.5];

        $collection = new FloatCollection(
            self::getRandomArrayEngine()
        );

        foreach ($arrayExpected as $item) {
            $collection->add($item);
        }

        self::assertEquals($arrayExpected, $collection->getList());
    }

    public function testCreateArrayFixed(): void
    {
        $collection = FloatCollection::create(10);
        self::assertInstanceOf(Collection::class, $collection);
        self::assertInstanceOf(FloatCollection::class, $collection);
    }

    public function testCreateArraySlice(): void
    {
        $collection = FloatCollection::create();
        self::assertInstanceOf(Collection::class, $collection);
        self::assertInstanceOf(FloatCollection::class, $collection);
    }
}
