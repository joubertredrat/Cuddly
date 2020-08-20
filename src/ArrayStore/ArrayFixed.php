<?php

declare(strict_types=1);

namespace RedRat\Cuddly\ArrayStore;

use Countable;
use RedRat\Cuddly\Exception\ArrayStore\ArrayFixed\InvalidSizeException;
use RedRat\Cuddly\Exception\ArrayStore\ArrayFixed\OutOfSizeException;

class ArrayFixed implements ArrayEngineInterface, Countable
{
    private const MIN_SIZE = 0;

    /**
     * @var ArraySlice
     */
    private $arrayStorage;

    /**
     * @var int
     */
    private $size;

    public function __construct(int $size)
    {
        if (self::MIN_SIZE > $size) {
            throw InvalidSizeException::handleMinimum(self::MIN_SIZE, $size);
        }

        $this->arrayStorage = new ArraySlice();
        $this->size = $size;
    }

    public function addElement($element): void
    {
        $this->checkSizeLimit();

        $this
            ->arrayStorage
            ->addElement($element)
        ;
    }

    public function hasElement($element): bool
    {
        return $this
            ->arrayStorage
            ->hasElement($element)
        ;
    }

    public function removeElement($element): void
    {
        $this
            ->arrayStorage
            ->removeElement($element)
        ;
    }

    public function countElements(): int
    {
        return $this
            ->arrayStorage
            ->countElements()
        ;
    }

    public function getArray(): array
    {
        return $this
            ->arrayStorage
            ->getArray()
        ;
    }

    public function count(): int
    {
        return $this->countElements();
    }

    public function getSize(): int
    {
        return $this->size;
    }

    private function checkSizeLimit(): void
    {
        if ($this->getSize() <= $this->countElements()) {
            throw OutOfSizeException::handle($this->getSize());
        }
    }
}
