<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Exception\ArrayStore\ArrayFixed;

use InvalidArgumentException;

use function sprintf;

class InvalidSizeException extends InvalidArgumentException
{
    public static function handleMinimum(int $sizeExpected, int $sizeGot): self
    {
        return new self(
            sprintf(
                'array size %d cannot be less than %d',
                $sizeGot,
                $sizeExpected
            )
        );
    }
}
