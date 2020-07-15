<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Collection\Type\Object;

use RedRat\Cuddly\Collection\Type\AbstractCollection;

class ObjectCollection extends AbstractCollection
{
    public function add(object $item, bool $acceptDuplicate = false): bool
    {
        return $this
            ->items
            ->add($item, $acceptDuplicate)
        ;
    }

    public function has(object $item): bool
    {
        return $this
            ->items
            ->has($item)
        ;
    }

    public function remove(object $item): bool
    {
        return $this
            ->items
            ->remove($item)
        ;
    }
}
