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

use Ergebnis\Rector\Rules\Arrays\SortAssociativeArrayByKeyRector;
use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;
use Guanguans\Notify\Foundation\Concerns\HasOptions;
use Guanguans\Notify\Foundation\Rectors\HasHttpClientDocCommentRector;
use Guanguans\Notify\Foundation\Rectors\HasOptionsDocCommentRector;
use Guanguans\Notify\Foundation\Rectors\ToInternalExceptionRector;
use Guanguans\Notify\Foundation\Response;
use GuzzleHttp\RequestOptions;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Scalar\LNumber;
use Rector\CodeQuality\Rector\ClassMethod\ExplicitReturnNullRector;
use Rector\CodeQuality\Rector\FuncCall\CompactToVariablesRector;
use Rector\CodeQuality\Rector\If_\ExplicitBoolCompareRector;
use Rector\CodeQuality\Rector\LogicalAnd\LogicalToBooleanRector;
use Rector\CodingStyle\Rector\ArrowFunction\StaticArrowFunctionRector;
use Rector\CodingStyle\Rector\Closure\StaticClosureRector;
use Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector;
use Rector\CodingStyle\Rector\Encapsed\WrapEncapsedVariableInCurlyBracesRector;
use Rector\CodingStyle\Rector\Stmt\NewlineAfterStatementRector;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\ClassMethod\RemoveUselessReturnTagRector;
use Rector\EarlyReturn\Rector\Return_\ReturnBinaryOrToEarlyReturnRector;
use Rector\Naming\Rector\ClassMethod\RenameParamToMatchTypeRector;
use Rector\Php73\Rector\String_\SensitiveHereNowDocRector;
use Rector\Php82\Rector\Param\AddSensitiveParameterAttributeRector;
use Rector\PHPUnit\Set\PHPUnitSetList;
use Rector\Removing\Rector\Class_\RemoveTraitUseRector;
use Rector\Renaming\Rector\FuncCall\RenameFunctionRector;
use Rector\Transform\Rector\ClassMethod\ReturnTypeWillChangeRector;
use Rector\Transform\Rector\FileWithoutNamespace\RectorConfigBuilderRector;
use Rector\Transform\Rector\Scalar\ScalarValueToConstFetchRector;
use Rector\Transform\Rector\String_\StringToClassConstantRector;
use Rector\Transform\ValueObject\ClassMethodReference;
use Rector\Transform\ValueObject\ScalarValueToConstFetch;
use Rector\Transform\ValueObject\StringToClassConstant;
use Rector\ValueObject\Visibility;
use Rector\Visibility\Rector\ClassMethod\ChangeMethodVisibilityRector;
use Rector\Visibility\ValueObject\ChangeMethodVisibility;

return RectorConfig::configure()
    ->withRootFiles()
    ->withPaths([
        __DIR__.'/src',
        __DIR__.'/tests',
        __DIR__.'/composer-updater',
        __DIR__.'/generate-ide-json',
        __DIR__.'/platform-lint',
    ])
    ->withSkipPath(__DIR__.'/tests.php')
    ->withSkip([
        '**/fixtures/*',
        '**/__snapshots__/*',
    ])
    ->withCache(__DIR__.'/.build/rector/')
    ->withParallel()
    // ->withoutParallel()
    ->withImportNames(false)
    ->withFluentCallNewLine()
    ->withAttributesSets(phpunit: true)
    ->withComposerBased(phpunit: true)
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
        phpunitCodeQuality: true,
    )
    ->withRules([
        RectorConfigBuilderRector::class,
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
    ->withConfiguredRule(RemoveTraitUseRector::class, [
        AsJson::class,
        AsPost::class,
    ])
    ->withConfiguredRule(ReturnTypeWillChangeRector::class, [
        new ClassMethodReference(ArrayAccess::class, 'offsetGet'),
        new ClassMethodReference(HasOptions::class, 'offsetGet'),
        new ClassMethodReference(Response::class, 'offsetGet'),
    ])
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
    ->withConfiguredRule(
        StringToClassConstantRector::class,
        array_reduce(
            [
                Guanguans\Notify\Foundation\Method::class,
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
        ),
    )
    ->withConfiguredRule(
        RenameFunctionRector::class,
        [
            'test' => 'it',
        ] + array_reduce(
            [
                // 'make',
                // 'env_explode',
            ],
            static function (array $carry, string $func): array {
                /** @see https://github.com/laravel/framework/blob/11.x/src/Illuminate/Support/functions.php */
                $carry[$func] = "Guanguans\\Notify\\Foundation\\Support\\$func";

                return $carry;
            },
            []
        )
    )
    ->withConfiguredRule(ScalarValueToConstFetchRector::class, array_map(
        static fn (int $value, string $constant): ScalarValueToConstFetch => new ScalarValueToConstFetch(
            new LNumber($value),
            new ClassConstFetch(new FullyQualified(Response::class), new Identifier($constant))
        ),
        $constants = array_filter(
            (new \ReflectionClass(Response::class))->getConstants(),
            static fn ($value): bool => \is_int($value),
        ),
        array_keys($constants)
    ))
    ->withSkip([
        EncapsedStringsToSprintfRector::class,
        ExplicitBoolCompareRector::class,
        LogicalToBooleanRector::class,
        NewlineAfterStatementRector::class,
        RemoveUselessReturnTagRector::class,
        ExplicitReturnNullRector::class,
        ReturnBinaryOrToEarlyReturnRector::class,
        SensitiveHereNowDocRector::class,
        WrapEncapsedVariableInCurlyBracesRector::class,
    ])
    ->withSkip([
        CompactToVariablesRector::class => [
            __DIR__.'/src/Foundation/Support/Utils.php',
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
            __DIR__.'/src/Foundation/Rfc',
            __DIR__.'/src/*/Messages/*.php',
            __DIR__.'/tests',
            __DIR__.'/src/Foundation/Support/Utils.php',
            __DIR__.'/src/Foundation/Response.php',
        ],
        SortAssociativeArrayByKeyRector::class => [
            __DIR__.'/src',
            __DIR__.'/tests',
        ],
    ]);
