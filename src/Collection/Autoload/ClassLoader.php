<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Collection\Autoload;

use function spl_autoload_register;

class ClassLoader
{
    public function __construct()
    {
        spl_autoload_register($this, true, true);
    }

    public function __invoke(string $classToLoad): bool
    {
        var_dump($classToLoad);
        return false;
    }
}
