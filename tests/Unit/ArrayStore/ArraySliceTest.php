<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Tests\Unit\ArrayStore;

use DateTime;
use PHPUnit\Framework\TestCase;
use RedRat\Cuddly\ArrayStore\ArraySlice;
use stdClass;

use function sprintf;

class ArraySliceTest extends TestCase
{
    public function testAddElement(): void
    {
        $arraySlice = new ArraySlice();

        self::assertEquals(0, $arraySlice->countElements());

        $arraySlice->addElement('foo');

        self::assertEquals(1, $arraySlice->countElements());

        $arraySlice->addElement('bar');
        $arraySlice->addElement(null);
        $arraySlice->addElement(true);
        $arraySlice->addElement(13.5);
        $arraySlice->addElement('foo');
        $arraySlice->addElement([1, 2, 3, 4, 5]);
        $arraySlice->addElement(new DateTime());

        self::assertEquals(8, $arraySlice->countElements());
    }

    public function testHasElement(): void
    {
        $arraySlice = new ArraySlice();
        $arraySlice->addElement('foo');

        self::assertTrue($arraySlice->hasElement('foo'));
        self::assertFalse($arraySlice->hasElement('bar'));
    }

    public function testRemoveElement(): void
    {
        $arraySlice = new ArraySlice();

        self::assertFalse($arraySlice->hasElement('foo'));

        $arraySlice->addElement('foo');

        self::assertTrue($arraySlice->hasElement('foo'));

        $arraySlice->removeElement('foo');

        self::assertFalse($arraySlice->hasElement('foo'));
    }

    public function testCountElements(): void
    {
        $arraySlice = new ArraySlice();

        self::assertEquals(0, $arraySlice->countElements());
        self::assertCount(0, $arraySlice);

        for ($i = 1; $i <= 30; $i++) {
            $arraySlice->addElement(
                sprintf('element-%d', $i)
            );
        }

        self::assertEquals(30, $arraySlice->countElements());
        self::assertCount(30, $arraySlice);

        for ($i = 31; $i <= 40; $i++) {
            $arraySlice->addElement(
                sprintf('element-%d', $i)
            );
        }

        self::assertEquals(40, $arraySlice->countElements());
        self::assertCount(40, $arraySlice);
    }

    public function testGetArray(): void
    {
        $arrayExpected = [
            'foo',
            'bar',
            true,
            new stdClass(),
            10,
            13.5,
            [1, 2, 3]
        ];

        $arraySlice = new ArraySlice();

        foreach ($arrayExpected as $element) {
            $arraySlice->addElement($element);
        }

        $arrayGot = $arraySlice->getArray();

        self::assertEquals($arrayExpected, $arrayGot);
    }
}
