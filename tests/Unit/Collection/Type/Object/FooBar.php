<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Tests\Unit\Collection\Type\Object;

class FooBar
{
    /**
     * @var string
     */
    private $bazQux;

    public function __construct(string $bazQux)
    {
        $this->bazQux = $bazQux;
    }
}
