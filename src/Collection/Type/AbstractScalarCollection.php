<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Collection\Type;

use RedRat\Cuddly\ArrayStore\ArrayFixed;
use RedRat\Cuddly\ArrayStore\ArraySlice;

use function is_int;

abstract class AbstractScalarCollection extends AbstractBaseCollection
{
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
