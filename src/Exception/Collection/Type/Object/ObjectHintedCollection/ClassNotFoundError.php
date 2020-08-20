<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Exception\Collection\Type\Object\ObjectHintedCollection;

use Error;

use function sprintf;

class ClassNotFoundError extends Error
{
    public static function handle(string $className): self
    {
        return new self(
            sprintf("Class '%s' not found", $className)
        );
    }
}
