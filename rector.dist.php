<?php

/** @noinspection PhpInternalEntityUsedInspection */
/** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

use Ergebnis\Rector\Rules\Arrays\SortAssociativeArrayByKeyRector;
use Ergebnis\Rector\Rules\Faker\GeneratorPropertyFetchToMethodCallRector;
use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;
use Guanguans\Notify\Foundation\Rectors\AddSensitiveParameterAttributeRector;
use Guanguans\Notify\Foundation\Rectors\HasHttpClientDocCommentRector;
use Guanguans\Notify\Foundation\Rectors\MessageRector;
use Guanguans\RectorRules\Rector\File\AddNoinspectionDocblockToFileFirstStmtRector;
use Guanguans\RectorRules\Rector\Name\RenameToConventionalCaseNameRector;
use Guanguans\RectorRules\Set\SetList;
use PhpParser\NodeVisitor\ParentConnectingVisitor;
use Rector\CodeQuality\Rector\If_\ExplicitBoolCompareRector;
use Rector\CodeQuality\Rector\LogicalAnd\LogicalToBooleanRector;
use Rector\CodingStyle\Rector\ArrowFunction\ArrowFunctionDelegatingCallToFirstClassCallableRector;
use Rector\CodingStyle\Rector\ArrowFunction\StaticArrowFunctionRector;
use Rector\CodingStyle\Rector\ClassLike\NewlineBetweenClassLikeStmtsRector;
use Rector\CodingStyle\Rector\Closure\StaticClosureRector;
use Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector;
use Rector\CodingStyle\Rector\Encapsed\WrapEncapsedVariableInCurlyBracesRector;
use Rector\CodingStyle\Rector\Enum_\EnumCaseToPascalCaseRector;
use Rector\CodingStyle\Rector\FuncCall\ArraySpreadInsteadOfArrayMergeRector;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\ClassMethod\RemoveParentDelegatingConstructorRector;
use Rector\EarlyReturn\Rector\If_\ChangeOrIfContinueToMultiContinueRector;
use Rector\EarlyReturn\Rector\Return_\ReturnBinaryOrToEarlyReturnRector;
use Rector\Naming\Rector\Assign\RenameVariableToMatchMethodCallReturnTypeRector;
use Rector\Naming\Rector\ClassMethod\RenameParamToMatchTypeRector;
use Rector\Php73\Rector\FuncCall\JsonThrowOnErrorRector;
use Rector\Removing\Rector\Class_\RemoveTraitUseRector;
use Rector\Renaming\Rector\FuncCall\RenameFunctionRector;
use Rector\Strict\Rector\Empty_\DisallowedEmptyRuleFixerRector;
use Rector\Transform\Rector\String_\StringToClassConstantRector;
use Rector\TypeDeclaration\Rector\StmtsAwareInterface\SafeDeclareStrictTypesRector;
use Rector\ValueObject\PhpVersion;

return RectorConfig::configure()
    ->withPaths([__DIR__.'/benchmarks/', __DIR__.'/src/', __DIR__.'/tests/', __DIR__.'/composer-bump'])
    ->withRootFiles()
    ->withSkip(['*/Fixtures/*', __DIR__.'/tests.php'])
    ->withCache(__DIR__.'/.build/rector/')
    // ->withoutParallel()
    ->withParallel()
    ->withImportNames(importDocBlockNames: false, importShortClasses: false)
    // ->withImportNames(importNames: false)
    // ->withEditorUrl()
    ->withFluentCallNewLine()
    ->withTreatClassesAsFinal()
    ->withAttributesSets(phpunit: true, all: true)
    ->withComposerBased(phpunit: true, laravel: true)
    ->withPhpVersion(PhpVersion::PHP_81)
    ->withDowngradeSets(php81: true)
    ->withPhpSets(php81: true)
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        codingStyle: true,
        typeDeclarations: true,
        typeDeclarationDocblocks: true,
        privatization: true,
        naming: true,
        instanceOf: true,
        earlyReturn: true,
        // strictBooleans: true,
        // carbon: true,
        rectorPreset: true,
        phpunitCodeQuality: true,
    )
    ->withSets([
        SetList::ALL,
    ])
    ->withRules([
        AddSensitiveParameterAttributeRector::class,
        HasHttpClientDocCommentRector::class,
        MessageRector::class,

        ArraySpreadInsteadOfArrayMergeRector::class,
        EnumCaseToPascalCaseRector::class,
        GeneratorPropertyFetchToMethodCallRector::class,
        JsonThrowOnErrorRector::class,
        SafeDeclareStrictTypesRector::class,
        SortAssociativeArrayByKeyRector::class,
        StaticArrowFunctionRector::class,
        StaticClosureRector::class,
    ])
    ->withConfiguredRule(AddNoinspectionDocblockToFileFirstStmtRector::class, [
        '*/tests/*' => [
            'AnonymousFunctionStaticInspection',
            'NullPointerExceptionInspection',
            'PhpFieldAssignmentTypeMismatchInspection',
            'PhpPossiblePolymorphicInvocationInspection',
            'PhpUndefinedClassInspection',
            'PhpUnhandledExceptionInspection',
            'PhpVoidFunctionResultUsedInspection',
            'StaticClosureCanBeUsedInspection',
        ],
    ])
    ->registerDecoratingNodeVisitor(ParentConnectingVisitor::class)
    ->withConfiguredRule(RenameToConventionalCaseNameRector::class, ['beforeEach', 'MIT', 'PDO'])
    ->withConfiguredRule(RemoveTraitUseRector::class, [AsJson::class, AsPost::class])
    ->withConfiguredRule(
        RenameFunctionRector::class,
        collect(['base64_encode_file', 'tap', 'value'])
            ->mapWithKeys(static fn (string $func): array => [$func => "Guanguans\\Notify\\Foundation\\Support\\$func"])
            ->all()
    )
    ->withSkip([
        ChangeOrIfContinueToMultiContinueRector::class,
        DisallowedEmptyRuleFixerRector::class,
        EncapsedStringsToSprintfRector::class,
        ExplicitBoolCompareRector::class,
        LogicalToBooleanRector::class,
        NewlineBetweenClassLikeStmtsRector::class,
        ReturnBinaryOrToEarlyReturnRector::class,
        WrapEncapsedVariableInCurlyBracesRector::class,
    ])
    ->withSkip([
        ArrowFunctionDelegatingCallToFirstClassCallableRector::class => [
            __DIR__.'/tests/Foundation/MessageTest.php',
        ],
        RemoveParentDelegatingConstructorRector::class => [
            __DIR__.'/src/Zulip/Authenticator.php',
        ],
        RemoveTraitUseRector::class => [
            __DIR__.'/src/Foundation/Message.php',
        ],
        RenameParamToMatchTypeRector::class => [
            __DIR__.'/src/Foundation/Rectors/',
            __DIR__.'/src/Foundation/Exceptions/RequestException.php',
        ],
        RenameVariableToMatchMethodCallReturnTypeRector::class => [
            __DIR__.'/src/Foundation/Rectors/',
        ],
        SortAssociativeArrayByKeyRector::class => [
            __DIR__.'/benchmarks/',
            __DIR__.'/src/',
            __DIR__.'/tests/',
        ],
        StaticArrowFunctionRector::class => $staticClosureSkipPaths = [
            __DIR__.'/tests/*Test.php',
            __DIR__.'/tests/Pest.php',
        ],
        StaticClosureRector::class => $staticClosureSkipPaths,
        StringToClassConstantRector::class => [
            __DIR__.'/benchmarks/',
            __DIR__.'/src/*/Messages/*.php',
            __DIR__.'/src/Foundation/Support/Utils.php',
            __DIR__.'/tests/',
            __DIR__.'/composer-bump',
        ],
    ]);
