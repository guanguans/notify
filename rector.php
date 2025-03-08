<?php

/** @noinspection PhpInternalEntityUsedInspection */
/** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

/**
 * Copyright (c) 2021-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

use Composer\Autoload\ClassLoader;
use Ergebnis\Rector\Rules\Arrays\SortAssociativeArrayByKeyRector;
use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;
use Guanguans\Notify\Foundation\Concerns\HasOptions;
use Guanguans\Notify\Foundation\Method;
use Guanguans\Notify\Foundation\Rectors\HasHttpClientDocCommentRector;
use Guanguans\Notify\Foundation\Rectors\HasOptionsDocCommentRector;
use Guanguans\Notify\Foundation\Rectors\ToInternalExceptionRector;
use Guanguans\Notify\Foundation\Response;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Collection;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Scalar\LNumber;
use Rector\CodeQuality\Rector\If_\ExplicitBoolCompareRector;
use Rector\CodeQuality\Rector\LogicalAnd\LogicalToBooleanRector;
use Rector\CodingStyle\Rector\ArrowFunction\StaticArrowFunctionRector;
use Rector\CodingStyle\Rector\Closure\StaticClosureRector;
use Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector;
use Rector\CodingStyle\Rector\Encapsed\WrapEncapsedVariableInCurlyBracesRector;
use Rector\CodingStyle\Rector\FuncCall\ArraySpreadInsteadOfArrayMergeRector;
use Rector\CodingStyle\Rector\Stmt\NewlineAfterStatementRector;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\ClassLike\RemoveAnnotationRector;
use Rector\DowngradePhp81\Rector\Array_\DowngradeArraySpreadStringKeyRector;
use Rector\EarlyReturn\Rector\Return_\ReturnBinaryOrToEarlyReturnRector;
use Rector\Naming\Rector\ClassMethod\RenameParamToMatchTypeRector;
use Rector\Php80\Rector\Class_\AnnotationToAttributeRector;
use Rector\Php80\ValueObject\AnnotationToAttribute;
use Rector\Php82\Rector\Param\AddSensitiveParameterAttributeRector;
use Rector\PHPUnit\Set\PHPUnitSetList;
use Rector\Removing\Rector\Class_\RemoveTraitUseRector;
use Rector\Renaming\Rector\FuncCall\RenameFunctionRector;
use Rector\Transform\Rector\ClassMethod\ReturnTypeWillChangeRector;
use Rector\Transform\Rector\Scalar\ScalarValueToConstFetchRector;
use Rector\Transform\Rector\String_\StringToClassConstantRector;
use Rector\Transform\ValueObject\ClassMethodReference;
use Rector\Transform\ValueObject\ScalarValueToConstFetch;
use Rector\Transform\ValueObject\StringToClassConstant;
use Rector\ValueObject\PhpVersion;
use Rector\ValueObject\Visibility;
use Rector\Visibility\Rector\ClassMethod\ChangeMethodVisibilityRector;
use Rector\Visibility\ValueObject\ChangeMethodVisibility;

return RectorConfig::configure()
    ->withPaths([
        __DIR__.'/benchmarks',
        __DIR__.'/src',
        __DIR__.'/tests',
        ...glob(__DIR__.'/{*,.*}.php', \GLOB_BRACE),
        __DIR__.'/composer-updater',
        __DIR__.'/generate-ide-json',
        __DIR__.'/platform-lint',
    ])
    ->withRootFiles()
    // ->withSkipPath(__DIR__.'/tests.php')
    ->withSkip([
        __DIR__.'/tests.php',
        '**/Fixtures/*',
        '**/__snapshots__/*',
    ])
    ->withCache(__DIR__.'/.build/rector/')
    ->withParallel()
    // ->withoutParallel()
    // ->withImportNames(importNames: false)
    ->withImportNames(importDocBlockNames: false, importShortClasses: false)
    ->withFluentCallNewLine()
    ->withAttributesSets(phpunit: true, all: true)
    ->withComposerBased(phpunit: true)
    ->withPhpVersion(PhpVersion::PHP_80)
    ->withDowngradeSets(php80: true)
    ->withPhpSets(php80: true)
    ->withSets([
        PHPUnitSetList::PHPUNIT_90,
    ])
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        codingStyle: true,
        typeDeclarations: true,
        privatization: true,
        naming: true,
        instanceOf: true,
        earlyReturn: true,
        rectorPreset: true,
        phpunitCodeQuality: true,
    )
    ->withRules([
        ArraySpreadInsteadOfArrayMergeRector::class,
        StaticArrowFunctionRector::class,
        StaticClosureRector::class,
        SortAssociativeArrayByKeyRector::class,
        HasHttpClientDocCommentRector::class,
        // HasOptionsDocCommentRector::class,
        ToInternalExceptionRector::class,
    ])
    ->withConfiguredRule(ChangeMethodVisibilityRector::class, [
        new ChangeMethodVisibility(HasOptions::class, 'preConfigureOptionsResolver', Visibility::PROTECTED),
    ])
    ->withConfiguredRule(RemoveAnnotationRector::class, [
        'phpstan-ignore',
        'phpstan-ignore-next-line',
        'psalm-suppress',
    ])
    ->withConfiguredRule(RemoveTraitUseRector::class, [
        AsJson::class,
        AsPost::class,
    ])
    // ->withConfiguredRule(ReturnTypeWillChangeRector::class, [
    //     new ClassMethodReference(ArrayAccess::class, 'offsetGet'),
    //     new ClassMethodReference(HasOptions::class, 'offsetGet'),
    //     new ClassMethodReference(Response::class, 'offsetGet'),
    // ])
    // ->withConfiguredRule(AnnotationToAttributeRector::class, array_map(
    //     static fn (string $class) => new AnnotationToAttribute(class_basename($class), $class, [], true),
    //     array_keys(iterator_to_array(
    //         (new ComposerFinder)
    //             ->inNamespace('PhpBench\Attributes')
    //             ->filter(static fn (ReflectionClass $reflectionClass): bool => $reflectionClass->isInstantiable())
    //     ))
    // ))
    ->withConfiguredRule(AnnotationToAttributeRector::class, array_map(
        static fn (string $class): AnnotationToAttribute => new AnnotationToAttribute(class_basename($class), $class, [], true),
        collect(spl_autoload_functions())
            ->pipe(static fn (Collection $splAutoloadFunctions): Collection => collect(
                $splAutoloadFunctions
                    ->firstOrFail(static fn (mixed $loader): bool => \is_array($loader) && $loader[0] instanceof ClassLoader)[0]
                    ->getClassMap()
            ))
            ->keys()
            ->filter(static fn (string $class): bool => str_starts_with($class, 'PhpBench\Attributes'))
            ->filter(static fn (string $class): bool => (new ReflectionClass($class))->isInstantiable())
            ->all()
    ))
    ->withConfiguredRule(AddSensitiveParameterAttributeRector::class, [
        AddSensitiveParameterAttributeRector::SENSITIVE_PARAMETERS => [
            'accessToken',
            'apiKey',
            'botApiKey',
            'key',
            'password',
            'pushKey',
            'secret',
            'tempKey',
            'token',
            'webHook',
        ],
    ])
    ->withConfiguredRule(RenameFunctionRector::class, [
        'Pest\Faker\fake' => 'fake',
        'Pest\Faker\faker' => 'faker',
        // 'faker' => 'fake',
        'test' => 'it',
    ] + array_reduce(
        [
            'rescue',
            'value',
            'base64_encode_file',
            'tap',
        ],
        static function (array $carry, string $func): array {
            /** @see https://github.com/laravel/framework/blob/11.x/src/Illuminate/Support/functions.php */
            $carry[$func] = "Guanguans\\Notify\\Foundation\\Support\\$func";

            return $carry;
        },
        []
    ))
    ->withConfiguredRule(StringToClassConstantRector::class, array_reduce(
        [
            Method::class,
            RequestOptions::class,
        ],
        static fn (array $carry, string $class): array => array_merge(
            $carry,
            array_map(
                static fn (string $string, string $constant): StringToClassConstant => new StringToClassConstant(
                    $string,
                    $class,
                    $constant,
                ),
                $constants = (new ReflectionClass($class))->getConstants(),
                array_keys($constants),
            ),
        ),
        [],
    ))
    ->withConfiguredRule(ScalarValueToConstFetchRector::class, array_map(
        static fn (int $value, string $constant): ScalarValueToConstFetch => new ScalarValueToConstFetch(
            new LNumber($value),
            new ClassConstFetch(new FullyQualified(Response::class), new Identifier($constant))
        ),
        $constants = array_filter(
            (new ReflectionClass(Response::class))->getConstants(),
            static fn ($value): bool => \is_int($value),
        ),
        array_keys($constants)
    ))
    ->withSkip([
        EncapsedStringsToSprintfRector::class,
        ExplicitBoolCompareRector::class,
        LogicalToBooleanRector::class,
        NewlineAfterStatementRector::class,
        ReturnBinaryOrToEarlyReturnRector::class,
        WrapEncapsedVariableInCurlyBracesRector::class,
    ])
    ->withSkip([
        DowngradeArraySpreadStringKeyRector::class => [
            __DIR__.'/src/Foundation/Message.php',
            __FILE__,
        ],
        RemoveTraitUseRector::class => [
            __DIR__.'/src/Foundation/Message.php',
        ],
        RenameParamToMatchTypeRector::class => [
            __DIR__.'/src/Foundation/Authenticators/AggregateAuthenticator.php',
            __DIR__.'/src/Foundation/Exceptions/RequestException.php',
        ],
        StaticArrowFunctionRector::class => $staticArrowFunctionPaths = [
            __DIR__.'/tests',
        ],
        StaticClosureRector::class => $staticArrowFunctionPaths,
        StringToClassConstantRector::class => [
            __DIR__.'/benchmarks',
            __DIR__.'/src/Foundation/Rfc',
            __DIR__.'/src/*/Messages/*.php',
            __DIR__.'/tests',
            __DIR__.'/src/Foundation/Support/Utils.php',
            __DIR__.'/src/Foundation/Response.php',
        ],
        SortAssociativeArrayByKeyRector::class => [
            __DIR__.'/benchmarks',
            __DIR__.'/src',
            __DIR__.'/tests',
        ],
    ]);
