<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Exception\ArrayStore\ArrayFixed;

use RuntimeException;

use function sprintf;

class OutOfSizeException extends RuntimeException
{
    public static function handle(int $size): self
    {
        return new self(sprintf('Array size %d reached', $size));
    }
}
