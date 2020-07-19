<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Collection\Factory;

use PhpParser\ParserFactory;
use RedRat\Cuddly\Collection\ClassBuilder\CollectionClassBuilder;
use RedRat\Cuddly\Collection\Collection;
use RedRat\Cuddly\Collection\GeneralCollection;
use RedRat\Cuddly\Collection\Type\Object\RedRatCuddlyPatoPatoCollection;
use RedRat\Cuddly\Exception\Collection\Factory\ObjectCollectionFactory\InvalidClassException;
use RedRat\Cuddly\Pato\Pato;
use RedRat\Cuddly\Vendor\Roave\BetterReflection\Util\Autoload\ClassLoaderMethod\OperationSystemTempFileCacheLoader;
use Roave\BetterReflection\BetterReflection;
use Roave\BetterReflection\Util\Autoload\ClassLoader;

use function class_exists;

class ObjectCollectionFactory
{
    public static function create(string $className): Collection
    {
        if (!class_exists($className)) {
            throw InvalidClassException::handle($className);
        }

//        $collectionClassBuilder = new CollectionClassBuilder($className);
//
//        dd($collectionClassBuilder->getClassCode());



        $classSuffix = str_replace('\\', '', $className);
//
        $code = <<<'CODE'
            declare(strict_types=1);

            namespace RedRat\Cuddly\Collection\Type\Object;

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

        $code = str_replace(['{{classSuffix}}', '{{type}}'], [$classSuffix, '\\' . $className], $code);

//        $parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
//        $ast = $parser->parse($code);

        eval($code);
        dump($classSuffix);

        $a = new RedRatCuddlyPatoPatoCollection();
        $a->add(new Pato());

        dd($a);


        $loader = new ClassLoader(
            OperationSystemTempFileCacheLoader::create()
        );

        $classInfo = (new BetterReflection())
            ->classReflector()
            ->reflect(GeneralCollection::class)
        ;

        $loader->addClass($classInfo);

        return new GeneralCollection();
    }
}
