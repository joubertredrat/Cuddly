<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Exception\Collection\Factory\ObjectCollectionFactory;

use RuntimeException;

use function sprintf;

class InvalidClassException extends RuntimeException
{
    public static function handle(string $className): self
    {
        return new self(
            sprintf('Invalid class got: [ %s ]', $className)
        );
    }
}
