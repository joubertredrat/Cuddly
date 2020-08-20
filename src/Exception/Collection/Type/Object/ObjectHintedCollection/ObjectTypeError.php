<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Exception\Collection\Type\Object\ObjectHintedCollection;

use TypeError;

use function sprintf;

class ObjectTypeError extends TypeError
{
    public static function handle(
        string $methodCalled,
        string $classNameHintExpected,
        string $classNameHintGot
    ): self {
        return new self(
            sprintf(
                'Argument 1 passed to %s must be of the instance %s, %s given',
                $methodCalled,
                $classNameHintExpected,
                $classNameHintGot
            )
        );
    }
}
