<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Collection\ClassBuilder;

use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter\Standard as CodePrinter;

use function str_replace;

class CollectionClassBuilder
{
    private string $className;

    public function __construct(string $className)
    {
        $this->className = $className;
    }

    public function getClassCode(): string
    {
        $code = <<<'CODE'
            <?php

            declare(strict_types=1);

            class {{classSuffix}}Collection extends \RedRat\Cuddly\Collection\Type\AbstractCollection
            {
                public function add({{type}} $item, bool $acceptDuplicate = false): bool
                {
                    return $this
                        ->items
                        ->add($item, $acceptDuplicate)
                    ;
                }

                public function has({{type}} $item): bool
                {
                    return $this
                        ->items
                        ->has($item)
                    ;
                }

                public function remove({{type}} $item): bool
                {
                    return $this
                        ->items
                        ->remove($item)
                    ;
                }
            }
        CODE;

        $classSuffix = str_replace('\\', '', $this->className);
        $classCode = str_replace(['{{classSuffix}}', '{{type}}'], [$classSuffix, '\\' . $this->className], $code);

        $parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
        $ast = $parser->parse($classCode);

        dd($ast);

//        return (new CodePrinter())->prettyPrint([$ast]);
    }
}
