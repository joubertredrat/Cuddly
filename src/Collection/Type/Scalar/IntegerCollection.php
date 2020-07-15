<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Collection\Type\Scalar;

use RedRat\Cuddly\Collection\Type\AbstractCollection;

class IntegerCollection extends AbstractCollection
{
    public function add(int $item, bool $acceptDuplicate = false): bool
    {
        return $this
            ->items
            ->add($item, $acceptDuplicate)
        ;
    }

    public function has(int $item): bool
    {
        return $this
            ->items
            ->has($item)
        ;
    }

    public function remove(int $item): bool
    {
        return $this
            ->items
            ->remove($item)
        ;
    }
}
