<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Collection\Type;

use RedRat\Cuddly\ArrayStore\ArrayEngineInterface;
use RedRat\Cuddly\ArrayStore\ArrayFixed;
use RedRat\Cuddly\ArrayStore\ArraySlice;
use RedRat\Cuddly\Collection\Collection;
use RedRat\Cuddly\Collection\GeneralCollection;
use RedRat\Cuddly\Collection\CollectionCountable;

use function is_int;

abstract class AbstractCollection implements Collection, CollectionCountable
{
    /**
     * @var GeneralCollection
     */
    protected $items;

    public function __construct(ArrayEngineInterface $arrayEngine)
    {
        $this->items = new GeneralCollection($arrayEngine);
    }

    public function count()
    {
        return $this
            ->items
            ->count()
        ;
    }

    public function getList(): array
    {
        return $this
            ->items
            ->getList()
        ;
    }

    public static function create(?int $size = null): self
    {
        if (is_int($size)) {
            return new static(
                new ArrayFixed($size)
            );
        }

        return new static(
            new ArraySlice()
        );
    }
}
