<?php

declare(strict_types=1);

namespace RedRat\Cuddly\ArrayStore;

use ArrayObject;
use Countable;

use function array_search;
use function count;
use function in_array;

class ArraySlice implements ArrayEngineInterface, Countable
{
    /**
     * @var ArrayObject
     */
    private $arrayStorage;

    public function __construct()
    {
        $this->arrayStorage = new ArrayObject();
    }

    public function addElement($element): void
    {
        $this
            ->arrayStorage
            ->append($element)
        ;
    }

    public function hasElement($element): bool
    {
        return in_array($element, $this->getArray(), true);
    }

    public function removeElement($element): void
    {
        if (!$this->hasElement($element)) {
            return;
        }

        $this
            ->arrayStorage
            ->offsetUnset(array_search($element, $this->getArray()))
        ;
    }

    public function countElements(): int
    {
        return count($this->arrayStorage);
    }

    public function getArray(): array
    {
        return (array) $this->arrayStorage;
    }

    public function count(): int
    {
        return $this->countElements();
    }
}
