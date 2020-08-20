<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Tests\Unit\Collection\Type\Object;

use PHPUnit\Framework\TestCase;
use RedRat\Cuddly\Collection\Collection;
use RedRat\Cuddly\Collection\Type\Object\ObjectHintedCollection;
use RedRat\Cuddly\Exception\Collection\Type\Object\ObjectHintedCollection\ClassNotFoundError;
use RedRat\Cuddly\Exception\Collection\Type\Object\ObjectHintedCollection\ObjectTypeError;
use RedRat\Cuddly\Tests\Unit\Collection\ArrayEngineHelperTrait;

class ObjectHintedCollectionTest extends TestCase
{
    use ArrayEngineHelperTrait;

    public function testConstructThrowClassNotFoundError(): void
    {
        self::expectException(ClassNotFoundError::class);

        $collection = new ObjectHintedCollection(
            self::getRandomArrayEngine(),
            BazQux::class
        );
    }

    public function testAdd(): void
    {
        $object1 = new FooBar('bazQux');

        $collection = new ObjectHintedCollection(
            self::getRandomArrayEngine(),
            FooBar::class
        );

        self::assertTrue($collection->add($object1));
        self::assertTrue($collection->add($object1, true));
        self::assertFalse($collection->add($object1));
    }

    public function testAddThrowObjectTypeError(): void
    {
        self::expectException(ObjectTypeError::class);

        $collection = new ObjectHintedCollection(
            self::getRandomArrayEngine(),
            FooBar::class
        );
        $collection->add(new \DateTime());
    }

    public function testHas(): void
    {
        $object1 = new FooBar('bazQux');

        $collection = new ObjectHintedCollection(
            self::getRandomArrayEngine(),
            FooBar::class
        );

        self::assertFalse($collection->has($object1));

        $collection->add($object1);

        self::assertTrue($collection->has($object1));
    }

    public function testHasThrowObjectTypeError(): void
    {
        self::expectException(ObjectTypeError::class);

        $collection = new ObjectHintedCollection(
            self::getRandomArrayEngine(),
            FooBar::class
        );
        $collection->has(new \DateTime());
    }

    public function testRemove(): void
    {
        $object1 = new FooBar('bazQux');

        $collection = new ObjectHintedCollection(
            self::getRandomArrayEngine(),
            FooBar::class
        );
        $collection->add($object1);

        self::assertTrue($collection->remove($object1));
        self::assertFalse($collection->remove($object1));
    }

    public function testRemoveThrowObjectTypeError(): void
    {
        self::expectException(ObjectTypeError::class);

        $collection = new ObjectHintedCollection(
            self::getRandomArrayEngine(),
            FooBar::class
        );
        $collection->remove(new \DateTime());
    }

    public function testCount(): void
    {
        $object1 = new FooBar('one');
        $object2 = new FooBar('two');
        $object3 = new FooBar('three');
        $object4 = new FooBar('four');

        $collection = new ObjectHintedCollection(
            self::getRandomArrayEngine(),
            FooBar::class
        );

        self::assertCount(0, $collection);

        $collection->add($object1);
        $collection->add($object2);

        self::assertCount(2, $collection);

        $collection->remove($object1);
        $collection->add($object3);
        $collection->add($object4);

        self::assertCount(3, $collection);
    }

    public function testGetList(): void
    {
        $arrayExpected = [
            new FooBar('one'),
            new FooBar('two'),
            new FooBar('three'),
            new FooBar('four'),
        ];

        $collection = new ObjectHintedCollection(
            self::getRandomArrayEngine(),
            FooBar::class
        );

        foreach ($arrayExpected as $item) {
            $collection->add($item);
        }

        self::assertEquals($arrayExpected, $collection->getList());
    }

    public function testCreateArrayFixed(): void
    {
        $collection = ObjectHintedCollection::create(FooBar::class, 10);
        self::assertInstanceOf(Collection::class, $collection);
        self::assertInstanceOf(ObjectHintedCollection::class, $collection);
    }

    public function testCreateArraySlice(): void
    {
        $collection = ObjectHintedCollection::create(FooBar::class);
        self::assertInstanceOf(Collection::class, $collection);
        self::assertInstanceOf(ObjectHintedCollection::class, $collection);
    }
}
