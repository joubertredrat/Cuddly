<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Collection\Type\Scalar;

use RedRat\Cuddly\Collection\Type\AbstractScalarCollection;

class FloatCollection extends AbstractScalarCollection
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
