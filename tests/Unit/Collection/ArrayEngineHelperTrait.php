<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Tests\Unit\Collection;

use RedRat\Cuddly\ArrayStore\ArrayEngineInterface;
use RedRat\Cuddly\ArrayStore\ArrayFixed;
use RedRat\Cuddly\ArrayStore\ArraySlice;

use function mt_rand;

trait ArrayEngineHelperTrait
{
    public static function getRandomArrayEngine(): ArrayEngineInterface
    {
        if (mt_rand(1, 100) > 50) {
            return new ArrayFixed(10);
        }

        return new ArraySlice();
    }
}
