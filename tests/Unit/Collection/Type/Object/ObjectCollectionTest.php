<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Tests\Unit\Collection\Type\Object;

use DateTime;
use DateTimeZone;
use Directory;
use PHPUnit\Framework\TestCase;
use RedRat\Cuddly\Collection\Collection;
use RedRat\Cuddly\Collection\Type\Object\ObjectCollection;
use RedRat\Cuddly\Tests\Unit\Collection\ArrayEngineHelperTrait;
use stdClass;

class ObjectCollectionTest extends TestCase
{
    use ArrayEngineHelperTrait;

    public function testAdd(): void
    {
        $object1 = new stdClass();

        $collection = new ObjectCollection(
            self::getRandomArrayEngine()
        );

        self::assertTrue($collection->add($object1));
        self::assertTrue($collection->add($object1, true));
        self::assertFalse($collection->add($object1));
    }

    public function testHas(): void
    {
        $object1 = new stdClass();
        $object2 = new DateTime('now');

        $collection = new ObjectCollection(
            self::getRandomArrayEngine()
        );

        self::assertFalse($collection->has($object1));
        self::assertFalse($collection->has($object2));

        $collection->add($object1);

        self::assertTrue($collection->has($object1));
    }

    public function testRemove(): void
    {
        $object1 = new stdClass();

        $collection = new ObjectCollection(
            self::getRandomArrayEngine()
        );
        $collection->add($object1);

        self::assertTrue($collection->remove($object1));
        self::assertFalse($collection->remove($object1));
    }

    public function testCount(): void
    {
        $object1 = new stdClass();
        $object2 = new DateTime('now');
        $object3 = new DateTimeZone('-0300');
        $object4 = new Directory();

        $collection = new ObjectCollection(
            self::getRandomArrayEngine()
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
            new stdClass(),
            new DateTime('now'),
            new DateTimeZone('-0300'),
            new Directory(),
        ];

        $collection = new ObjectCollection(
            self::getRandomArrayEngine()
        );

        foreach ($arrayExpected as $item) {
            $collection->add($item);
        }

        self::assertEquals($arrayExpected, $collection->getList());
    }

    public function testCreateArrayFixed(): void
    {
        $collection = ObjectCollection::create(10);
        self::assertInstanceOf(Collection::class, $collection);
        self::assertInstanceOf(ObjectCollection::class, $collection);
    }

    public function testCreateArraySlice(): void
    {
        $collection = ObjectCollection::create();
        self::assertInstanceOf(Collection::class, $collection);
        self::assertInstanceOf(ObjectCollection::class, $collection);
    }
}
