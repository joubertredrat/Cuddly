<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Collection;

use Countable;

use function array_search;
use function count;
use function in_array;

class Collection implements Countable
{
    private array $items;

    public function __construct()
    {
        $this->clear();
    }

    public function add($item, bool $acceptDuplicate = false): bool
    {
        if ($this->has($item) && !$acceptDuplicate) {
            return false;
        }

        $this->items[] = $item;
        return true;
    }

    public function has($item): bool
    {
        return in_array($item, $this->items);
    }

    public function remove($item): bool
    {
        if (!$this->has($item)) {
            return false;
        }

        $itemKey = array_search($item, $this->items);
        unset($this->items[$itemKey]);

        return true;
    }

    public function clear(): void
    {
        $this->items = [];
    }

    public function count()
    {
        return count($this->items);
    }

    public function getList(): array
    {
        return $this->items;
    }
}
