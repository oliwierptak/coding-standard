<?php declare(strict_types = 1);

namespace Everon\Sniffs\Files;

use SlevomatCodingStandard\Helpers\ClassHelper;
use SlevomatCodingStandard\Helpers\NamespaceHelper;
use SlevomatCodingStandard\Helpers\StringHelper;
use SlevomatCodingStandard\Helpers\TokenHelper;

/**
 * Based on SlevomatCodingStandard.Files.TypeNameMatchesFileName
 *
 * @see https://github.com/slevomat/coding-standard
 *
 * Requires to have rootNamespaces provided, works with relative paths.
 *
 *   <rule ref="Everon.Files.TypeNameMatchesFileName">
 *      <properties>
 *          <property name="rootNamespaces" type="array"
 *                    value="src/Foo=>Foo,tests/Foo=>Tests\Foo"/>
 *          <property name="ignoredNamespaces" type="array"
 *                    value="Tests\Generated"/>
 *          <property name="skipDirs" type="array"
 *                    value="src/Generated"/>
 *          <property name="extensions" type="array"
 *                    value="php"/>
 *      </properties>
 *  </rule>
 */
class TypeNameMatchesFileNameSniff implements \PHP_CodeSniffer\Sniffs\Sniff
{
    public const CODE_NO_MATCH_BETWEEN_TYPE_NAME_AND_FILE_NAME = 'NoMatchBetweenTypeNameAndFileName';

    /**
     * @var array
     */
    public $rootNamespaces = [];

    /**
     * @var array
     */
    public $skipDirs = [];

    /**
     * @var array
     */
    public $extensions = ['php'];

    /**
     * @return mixed[]
     */
    public function register(): array
    {
        return [
            T_CLASS,
            T_INTERFACE,
            T_TRAIT,
        ];
    }

    /**
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint
     * @phpcsSuppress SlevomatCodingStandard.Files.TypeNameMatchesFileName
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile
     * @param int $typePointer
     */
    public function process(\PHP_CodeSniffer\Files\File $phpcsFile, $typePointer): void
    {
        $tokens = $phpcsFile->getTokens();

        /** @var int $namePointer */
        $namePointer = TokenHelper::findNext($phpcsFile, T_STRING, $typePointer + 1);
        $namespacePointer = TokenHelper::findPrevious($phpcsFile, T_NAMESPACE, $typePointer - 1);

        if (!$this->hasNamespace($namespacePointer)) {
            return;
        }

        $typeName = NamespaceHelper::normalizeToCanonicalName(
            ClassHelper::getFullyQualifiedName($phpcsFile, $typePointer)
        );

        $rootDirectory = \getcwd() . \DIRECTORY_SEPARATOR;
        $fileInfo = new \SplFileInfo($phpcsFile->getFilename());

        foreach ($this->rootNamespaces as $directory => $namespace) {
            if ($this->shouldSkip($directory)) {
                return;
            }

            if (StringHelper::startsWith($typeName, $namespace)) {
                $expectedTypeName = rtrim($fileInfo->getPathname(), '.' . $fileInfo->getExtension());
                $expectedTypeName = \str_replace($rootDirectory . $directory, '', $expectedTypeName);
                $expectedTypeName = \str_replace(\DIRECTORY_SEPARATOR, '\\', $expectedTypeName);
                $expectedTypeName = $namespace . '\\' . ltrim($expectedTypeName, '\\');

                if (strcasecmp($typeName, $expectedTypeName) === 0) {
                    return;
                }
            }
        }

        $phpcsFile->addError(
            sprintf(
                '%s name %s does not match filepath %s.',
                ucfirst($tokens[$typePointer]['content']),
                $typeName,
                $phpcsFile->getFilename()
            ),
            $namePointer,
            self::CODE_NO_MATCH_BETWEEN_TYPE_NAME_AND_FILE_NAME
        );
    }

    protected function hasNamespace(?int $namespacePointer): bool
    {
        return $namespacePointer !== null;
    }

    protected function shouldSkip(string $directory): bool
    {
        foreach ($this->skipDirs as $skipDir) {
            if (StringHelper::startsWith($skipDir, $directory)) {
                return true;
            }
        }

        return false;
    }
}
