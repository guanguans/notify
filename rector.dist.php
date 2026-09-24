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

use Ergebnis\Rector\Rules\Expressions\Arrays\SortAssociativeArrayByKeyRector;
use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;
use Guanguans\Notify\Foundation\Rectors\AddSensitiveParameterAttributeRector;
use Guanguans\Notify\Foundation\Rectors\HasHttpClientDocCommentRector;
use Guanguans\Notify\Foundation\Rectors\MessageRector;
use Guanguans\PhpCsFixerCustomFixers\Support\Utils;
use Guanguans\RectorRules\NodeVisitor\ParentConnectingVisitor;
use Guanguans\RectorRules\Rector\File\AddNoinspectionDocblockToFileFirstStmtRector;
use Guanguans\RectorRules\Rector\Name\RenameToConventionalCaseNameRector;
use Guanguans\RectorRules\Set\SetList;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Rector\CodeQuality\Rector\LogicalAnd\LogicalToBooleanRector;
use Rector\CodingStyle\Rector\Assign\SplitDoubleAssignRector;
use Rector\CodingStyle\Rector\ClassLike\NewlineBetweenClassLikeStmtsRector;
use Rector\Config\RectorConfig;
use Rector\Naming\Rector\Assign\RenameVariableToMatchMethodCallReturnTypeRector;
use Rector\Naming\Rector\ClassMethod\RenameParamToMatchTypeRector;
use Rector\PHPUnit\CodeQuality\Rector\Class_\PreferPHPUnitThisCallRector;
use Rector\PostRector\Rector\NameImportingPostRector;
use Rector\Removing\Rector\Class_\RemoveTraitUseRector;
use Rector\Renaming\Rector\FuncCall\RenameFunctionRector;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Transform\Rector\String_\StringToClassConstantRector;
use Rector\ValueObject\PhpVersion;
use RectorPest\Set\PestLevelSetList;
use RectorPest\Set\PestSetList;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

error_reporting(\E_ALL & ~\E_DEPRECATED & ~\E_USER_DEPRECATED);

return RectorConfig::configure()
    ->withPaths([...Utils::defaultRootDirectories(), ...Utils::defaultRootFiles()])
    ->withRootFiles()
    ->withSkip(['*/Fixtures/*'])
    ->withSkip([
        NameImportingPostRector::class,

        LogicalToBooleanRector::class,
        NewlineBetweenClassLikeStmtsRector::class,
        PreferPHPUnitThisCallRector::class,
        SplitDoubleAssignRector::class,
    ])
    ->withSkip([
        // NameImportingPostRector::class => [
        //     __DIR__.'/src/Foundation/Rectors/HasHttpClientDocCommentRector.php',
        // ],
        RemoveTraitUseRector::class => [
            __DIR__.'/src/Foundation/Message.php',
        ],
        RenameClassRector::class => [
            __DIR__.'/src/Foundation/Rectors/',
            __DIR__.'/composer-bump',
            __FILE__,
        ],
        RenameParamToMatchTypeRector::class => [
            __DIR__.'/src/Foundation/Rectors/',
            __DIR__.'/src/Foundation/Exceptions/RequestException.php',
            __DIR__.'/tests/Pest.php',
        ],
        RenameVariableToMatchMethodCallReturnTypeRector::class => [
            __DIR__.'/src/Foundation/Rectors/',
        ],
        SortAssociativeArrayByKeyRector::class => [
            /** @see vendor/rector/rector/src/PostRector/Rector/ */
            __DIR__.'/benchmarks/',
            __DIR__.'/src/',
            __DIR__.'/tests/',
        ],
        StringToClassConstantRector::class => [
            __DIR__.'/benchmarks/',
            __DIR__.'/src/*/Messages/*.php',
            __DIR__.'/src/Foundation/Support/Utils.php',
            __DIR__.'/tests/',
            __DIR__.'/composer-bump',
        ],
    ])
    ->withCache(__DIR__.'/.build/rector/')
    // ->withoutParallel()
    ->withParallel()
    ->withImportNames(importDocBlockNames: false, importShortClasses: false, removeUnusedImports: false)
    // ->withImportNames(true, false, false, false)
    ->reportUnusedSkips()
    ->withFluentCallNewLine()
    ->withTreatClassesAsFinal()
    ->withTypeGuardedClasses([])
    ->withAttributesSets(phpunit: true, all: true)
    ->withComposerBased(phpunit: true/* , laravel: true */)
    ->withPhpVersion(PhpVersion::PHP_82)
    ->withDowngradeSets(php82: true)
    ->withPhpSets(php82: true)
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        codingStyle: true,
        typeDeclarations: true,
        typeDeclarationDocblocks: true,
        privatization: true,
        naming: true,
        // namedArgs: true,
        // carbon: true,
        rectorPreset: true,
        phpunitCodeQuality: true,
        phpunitNarrowAsserts: true,
        phpunitMockToStub: true,
    )
    ->withSets([
        SetList::ALL,
        PestLevelSetList::UP_TO_PEST_30,
        PestSetList::PEST_CODE_QUALITY,
    ])
    ->withRules([
        // AddSensitiveParameterAttributeRector::class,
        HasHttpClientDocCommentRector::class,
        MessageRector::class,
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
    ->withConfiguredRule(RenameClassRector::class, [
        Arr::class => Guanguans\Notify\Foundation\Support\Arr::class,
        Options::class => OptionsResolver::class,
        Str::class => Guanguans\Notify\Foundation\Support\Str::class,
    ]);
