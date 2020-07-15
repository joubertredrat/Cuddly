<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Collection\Type\Scalar;

use RedRat\Cuddly\Collection\Type\AbstractCollection;

class StringCollection extends AbstractCollection
{
    public function add(string $item, bool $acceptDuplicate = false): bool
    {
        return $this
            ->items
            ->add($item, $acceptDuplicate)
        ;
    }

    public function has(string $item): bool
    {
        return $this
            ->items
            ->has($item)
        ;
    }

    public function remove(string $item): bool
    {
        return $this
            ->items
            ->remove($item)
        ;
    }
}
