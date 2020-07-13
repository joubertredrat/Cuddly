<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Collection\Scalar;

class FloatCollection extends AbstractCollection
{
    public function add(float $item, bool $acceptDuplicate = false): bool
    {
        return $this
            ->items
            ->add($item, $acceptDuplicate)
        ;
    }

    public function has(float $item): bool
    {
        return $this
            ->items
            ->has($item)
        ;
    }

    public function remove(float $item): bool
    {
        return $this
            ->items
            ->remove($item)
        ;
    }
}
