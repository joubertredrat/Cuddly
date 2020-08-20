<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Collection;

use RedRat\Cuddly\ArrayStore\ArrayEngineInterface;
use RedRat\Cuddly\ArrayStore\ArrayFixed;
use RedRat\Cuddly\ArrayStore\ArraySlice;

use function is_int;

class GeneralCollection implements Collection, CollectionCountable
{
    /**
     * @var ArrayEngineInterface
     */
    private $arrayEngine;

    public function __construct(ArrayEngineInterface $arrayEngine)
    {
        $this->arrayEngine = $arrayEngine;
    }

    public function add($item, bool $acceptDuplicate = false): bool
    {
        if ($this->has($item) && !$acceptDuplicate) {
            return false;
        }

        $this
            ->arrayEngine
            ->addElement($item)
        ;

        return true;
    }

    public function has($item): bool
    {
        return $this
            ->arrayEngine
            ->hasElement($item)
        ;
    }

    public function remove($item): bool
    {
        if (!$this->has($item)) {
            return false;
        }

        $this
            ->arrayEngine
            ->removeElement($item)
        ;

        return true;
    }

    public function count(): int
    {
        return $this
            ->arrayEngine
            ->countElements()
        ;
    }

    public function getList(): array
    {
        return $this
            ->arrayEngine
            ->getArray()
        ;
    }

    public static function create(?int $size = null): self
    {
        if (is_int($size)) {
            return new self(
                new ArrayFixed($size)
            );
        }

        return new self(
            new ArraySlice()
        );
    }
}
