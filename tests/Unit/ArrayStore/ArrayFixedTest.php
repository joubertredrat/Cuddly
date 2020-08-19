<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Tests\Unit\ArrayStore;

use DateTime;
use PHPUnit\Framework\TestCase;
use RedRat\Cuddly\ArrayStore\ArrayFixed;
use RedRat\Cuddly\Exception\ArrayStore\ArrayFixed\InvalidSizeException;
use RedRat\Cuddly\Exception\ArrayStore\ArrayFixed\OutOfSizeException;
use stdClass;

use function mt_rand;
use function sprintf;

class ArrayFixedTest extends TestCase
{
    public function testConstructThrowInvalidSizeException(): void
    {
        self::expectException(InvalidSizeException::class);

        new ArrayFixed(-10);
    }

    public function testAddElement(): void
    {
        $arrayFixed = new ArrayFixed(10);

        self::assertEquals(0, $arrayFixed->countElements());

        $arrayFixed->addElement('foo');

        self::assertEquals(1, $arrayFixed->countElements());

        $arrayFixed->addElement('bar');
        $arrayFixed->addElement(null);
        $arrayFixed->addElement(true);
        $arrayFixed->addElement(13.5);
        $arrayFixed->addElement('foo');
        $arrayFixed->addElement([1, 2, 3, 4, 5]);
        $arrayFixed->addElement(new DateTime());

        self::assertEquals(8, $arrayFixed->countElements());
    }

    public function testAddElementThrowOutOfSizeException(): void
    {
        self::expectException(OutOfSizeException::class);

        $arrayFixed = new ArrayFixed(1);
        $arrayFixed->addElement('foo');
        $arrayFixed->addElement('bar');
    }

    public function testHasElement(): void
    {
        $arrayFixed = new ArrayFixed(10);
        $arrayFixed->addElement('foo');

        self::assertTrue($arrayFixed->hasElement('foo'));
        self::assertFalse($arrayFixed->hasElement('bar'));
    }

    public function testRemoveElement(): void
    {
        $arrayFixed = new ArrayFixed(10);

        self::assertFalse($arrayFixed->hasElement('foo'));

        $arrayFixed->addElement('foo');

        self::assertTrue($arrayFixed->hasElement('foo'));

        $arrayFixed->removeElement('foo');

        self::assertFalse($arrayFixed->hasElement('foo'));
    }

    public function testCountElements(): void
    {
        $arrayFixed = new ArrayFixed(50);

        self::assertEquals(0, $arrayFixed->countElements());
        self::assertCount(0, $arrayFixed);

        for ($i = 1; $i <= 30; $i++) {
            $arrayFixed->addElement(
                sprintf('element-%d', $i)
            );
        }

        self::assertEquals(30, $arrayFixed->countElements());
        self::assertCount(30, $arrayFixed);

        for ($i = 31; $i <= 40; $i++) {
            $arrayFixed->addElement(
                sprintf('element-%d', $i)
            );
        }

        self::assertEquals(40, $arrayFixed->countElements());
        self::assertCount(40, $arrayFixed);

        for ($i = 1; $i <= 10; $i++) {
            $arrayFixed->removeElement(
                sprintf('element-%d', $i)
            );
        }

        self::assertEquals(30, $arrayFixed->countElements());
        self::assertCount(30, $arrayFixed);
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

        $arrayFixed = new ArrayFixed(50);

        foreach ($arrayExpected as $element) {
            $arrayFixed->addElement($element);
        }

        $arrayGot = $arrayFixed->getArray();

        self::assertEquals($arrayExpected, $arrayGot);
    }

    public function testGetSize(): void
    {
        $sizeExpected = mt_rand(1, 9999);
        $arrayFixed = new ArrayFixed($sizeExpected);
        $sizeGot = $arrayFixed->getSize();

        self::assertEquals($sizeExpected, $sizeGot);
    }
}
