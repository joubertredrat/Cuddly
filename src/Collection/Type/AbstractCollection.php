<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Collection\Type;

use RedRat\Cuddly\Collection\Collection;
use RedRat\Cuddly\Collection\GeneralCollection;
use RedRat\Cuddly\Collection\CollectionCountable;

abstract class AbstractCollection implements Collection, CollectionCountable
{
    protected GeneralCollection $items;

    public function __construct()
    {
        $this->clear();
    }

    public function clear(): void
    {
        $this->items = new GeneralCollection();
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
