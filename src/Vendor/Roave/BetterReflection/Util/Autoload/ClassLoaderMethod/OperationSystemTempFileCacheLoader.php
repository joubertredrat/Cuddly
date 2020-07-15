<?php

declare(strict_types=1);

namespace RedRat\Cuddly\Vendor\Roave\BetterReflection\Util\Autoload\ClassLoaderMethod;

use Roave\BetterReflection\Reflection\ReflectionClass;
use Roave\BetterReflection\Util\Autoload\ClassLoaderMethod\Exception\SignatureCheckFailed;
use Roave\BetterReflection\Util\Autoload\ClassLoaderMethod\LoaderMethodInterface;
use Roave\BetterReflection\Util\Autoload\ClassPrinter\ClassPrinterInterface;
use Roave\BetterReflection\Util\Autoload\ClassPrinter\PhpParserPrinter;
use Roave\Signature\CheckerInterface;
use Roave\Signature\Encoder\Sha1SumEncoder;
use Roave\Signature\FileContentChecker;
use Roave\Signature\FileContentSigner;
use Roave\Signature\SignerInterface;

use function file_exists;
use function file_put_contents;
use function sha1;
use function sprintf;
use function str_replace;
use function sys_get_temp_dir;

final class OperationSystemTempFileCacheLoader implements LoaderMethodInterface
{
    private ClassPrinterInterface $classPrinter;
    private SignerInterface $signer;
    private CheckerInterface $checker;

    public function __construct(
        ClassPrinterInterface $classPrinter,
        SignerInterface $signer,
        CheckerInterface $checker
    ) {
        $this->classPrinter = $classPrinter;
        $this->signer = $signer;
        $this->checker = $checker;
    }

    private function getFilename(string $className): string
    {
        return sprintf(
            '%s/php-class-cache-%s',
            sys_get_temp_dir(),
            sha1($className),
        );
    }

    public function __invoke(ReflectionClass $classInfo): void
    {
        $filename = $this->getFilename($classInfo->getName());
        
        if (!file_exists($filename)) {
            $code = "<?php\n" . $this->classPrinter->__invoke($classInfo);
            file_put_contents(
                $filename,
                str_replace('<?php', "<?php\n// " . $this->signer->sign($code), $code),
            );
        }

        if (!$this->checker->check(file_get_contents($filename))) {
            throw SignatureCheckFailed::fromReflectionClass($classInfo);
        }

        /** @noinspection PhpIncludeInspection */
        require_once $filename;
    }

    public static function create(): self
    {
        return new self(
            new PhpParserPrinter(),
            new FileContentSigner(new Sha1SumEncoder()),
            new FileContentChecker(new Sha1SumEncoder()),
        );
    }
}
