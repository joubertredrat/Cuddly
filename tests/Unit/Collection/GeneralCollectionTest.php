<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Tests\Unit\Collection;

use PHPUnit\Framework\TestCase;
use RedRat\Cuddly\Collection\Collection;
use RedRat\Cuddly\Collection\GeneralCollection;

class GeneralCollectionTest extends TestCase
{
    use ArrayEngineHelperTrait;

    public function testAdd(): void
    {
        $collection = new GeneralCollection(
            self::getRandomArrayEngine()
        );

        self::assertTrue($collection->add('foo'));
        self::assertTrue($collection->add('foo', true));
        self::assertFalse($collection->add('foo'));
    }

    public function testHas(): void
    {
        $collection = new GeneralCollection(
            self::getRandomArrayEngine()
        );
        $collection->add('foo');

        self::assertTrue($collection->has('foo'));
        self::assertFalse($collection->has('bar'));
    }

    public function testRemove(): void
    {
        $collection = new GeneralCollection(
            self::getRandomArrayEngine()
        );
        $collection->add('foo');

        self::assertTrue($collection->remove('foo'));
        self::assertFalse($collection->remove('foo'));
    }

    public function testCount(): void
    {
        $collection = new GeneralCollection(
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
        $arrayExpected = [
            'foo',
            10,
            'bar',
            null,
            true,
            'baz',
            12.5,
            'qux',
            ['one', 'two'],
            'quux'
        ];

        $collection = new GeneralCollection(
            self::getRandomArrayEngine()
        );

        foreach ($arrayExpected as $item) {
            $collection->add($item);
        }

        self::assertEquals($arrayExpected, $collection->getList());
    }

    public function testCreateArrayFixed(): void
    {
        $collection = GeneralCollection::create(10);
        self::assertInstanceOf(Collection::class, $collection);
        self::assertInstanceOf(GeneralCollection::class, $collection);
    }

    public function testCreateArraySlice(): void
    {
        $collection = GeneralCollection::create();
        self::assertInstanceOf(Collection::class, $collection);
        self::assertInstanceOf(GeneralCollection::class, $collection);
    }
}
