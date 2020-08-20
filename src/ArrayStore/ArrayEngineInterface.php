<?php

declare(strict_types=1);

namespace RedRat\Cuddly\ArrayStore;

interface ArrayEngineInterface
{
    public function addElement($element): void;

    public function hasElement($element): bool;

    public function removeElement($element): void;

    public function countElements(): int;

    public function getArray(): array;
}
