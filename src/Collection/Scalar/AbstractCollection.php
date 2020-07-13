<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Collection\Scalar;

use RedRat\Cuddly\Collection\Collection;
use RedRat\Cuddly\Collection\CollectionCountable;

abstract class AbstractCollection implements CollectionCountable
{
    protected Collection $items;

    public function __construct()
    {
        $this->clear();
    }

    public function clear(): void
    {
        $this->items = new Collection();
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
}
