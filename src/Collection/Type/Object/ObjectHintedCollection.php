<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Collection\Type\Object;

use RedRat\Cuddly\ArrayStore\ArrayEngineInterface;
use RedRat\Cuddly\Collection\Type\AbstractCollection;
use RedRat\Cuddly\Exception\Collection\Type\Object\ObjectHintedCollection\ClassNotFoundError;
use RedRat\Cuddly\Exception\Collection\Type\Object\ObjectHintedCollection\ObjectTypeError;

use function class_exists;
use function get_class;

class ObjectHintedCollection extends AbstractCollection
{
    /**
     * @var string
     */
    private $className;

    public function __construct(
        ArrayEngineInterface $arrayEngine,
        string $className
    ) {
        if (!class_exists($className)) {
            throw ClassNotFoundError::handle($className);
        }

        parent::__construct($arrayEngine);
        $this->className = $className;
    }

    public function add(object $item, bool $acceptDuplicate = false): bool
    {
        $this->checkTypeHint($item, __METHOD__);

        return $this
            ->items
            ->add($item, $acceptDuplicate)
        ;
    }

    public function has(object $item): bool
    {
        $this->checkTypeHint($item, __METHOD__);

        return $this
            ->items
            ->has($item)
        ;
    }

    public function remove(object $item): bool
    {
        $this->checkTypeHint($item, __METHOD__);

        return $this
            ->items
            ->remove($item)
        ;
    }

    private function checkTypeHint(object $item, string $methodCalled): void
    {
        if (!$item instanceof $this->className) {
            throw ObjectTypeError::handle(
                $methodCalled,
                $this->className,
                get_class($item)
            );
        }
    }
}
