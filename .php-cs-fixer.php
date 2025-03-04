<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

use Ergebnis\License\Holder;
use Ergebnis\License\Range;
use Ergebnis\License\Type\MIT;
use Ergebnis\License\Url;
use Ergebnis\License\Year;
use Ergebnis\PhpCsFixer\Config\Factory;
use Ergebnis\PhpCsFixer\Config\Fixers;
use Ergebnis\PhpCsFixer\Config\Rules;
use Ergebnis\PhpCsFixer\Config\RuleSet\Php80;
use PhpCsFixer\Finder;
use PhpCsFixer\Fixer\DeprecatedFixerInterface;
use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;
use PhpCsFixerCustomFixers\Fixer\AbstractFixer;

$license = MIT::text(
    __DIR__.'/LICENSE',
    Range::since(
        Year::fromString('2021'),
        new DateTimeZone('Asia/Shanghai'),
    ),
    Holder::fromString('guanguans<ityaozm@gmail.com>'),
    Url::fromString('https://github.com/guanguans/notify'),
);

$license->save();

$ruleSet = Php80::create()
    ->withHeader($license->header())
    ->withRules(Rules::fromArray([
        '@PHP70Migration' => true,
        '@PHP70Migration:risky' => true,
        '@PHP71Migration' => true,
        '@PHP71Migration:risky' => true,
        '@PHP73Migration' => true,
        '@PHP74Migration' => true,
        '@PHP74Migration:risky' => true,
        '@PHP80Migration' => true,
        '@PHP80Migration:risky' => true,
        // '@PHP81Migration' => true,
        // '@PHP82Migration' => true,
        // '@PHP83Migration' => true,
        // '@PHPUnit75Migration:risky' => true,
        // '@PHPUnit84Migration:risky' => true,
        // '@PHPUnit100Migration:risky' => true,
        // '@DoctrineAnnotation' => true,
        // '@PhpCsFixer' => true,
        // '@PhpCsFixer:risky' => true,
        'attribute_empty_parentheses' => [
            'use_parentheses' => false,
        ],
        'blank_line_before_statement' => [
            'statements' => [
                'break',
                // 'case',
                'continue',
                'declare',
                // 'default',
                'do',
                'exit',
                'for',
                'foreach',
                'goto',
                'if',
                'include',
                'include_once',
                'phpdoc',
                'require',
                'require_once',
                'return',
                'switch',
                'throw',
                'try',
                'while',
                'yield',
                'yield_from',
            ],
        ],
        'class_definition' => [
            'inline_constructor_arguments' => false,
            'multi_line_extends_each_single_line' => false,
            'single_item_single_line' => false,
            'single_line' => false,
            'space_before_parenthesis' => false,
        ],
        'concat_space' => [
            'spacing' => 'none',
        ],
        // 'empty_loop_condition' => [
        //     'style' => 'for',
        // ],
        'explicit_string_variable' => false,
        'final_class' => false,
        // 'final_internal_class' => false,
        // 'final_public_method_for_abstract_class' => false,
        'fully_qualified_strict_types' => [
            'import_symbols' => false,
            'leading_backslash_in_global_namespace' => false,
            'phpdoc_tags' => [
                // 'param',
                // 'phpstan-param',
                // 'phpstan-property',
                // 'phpstan-property-read',
                // 'phpstan-property-write',
                // 'phpstan-return',
                // 'phpstan-var',
                // 'property',
                // 'property-read',
                // 'property-write',
                // 'psalm-param',
                // 'psalm-property',
                // 'psalm-property-read',
                // 'psalm-property-write',
                // 'psalm-return',
                // 'psalm-var',
                // 'return',
                // 'see',
                // 'throws',
                // 'var',
            ],
        ],
        'logical_operators' => false,
        'mb_str_functions' => false,
        'native_function_invocation' => [
            'exclude' => [],
            'include' => ['@compiler_optimized', 'is_scalar'],
            'scope' => 'all',
            'strict' => true,
        ],
        'new_with_parentheses' => [
            'anonymous_class' => false,
            'named_class' => false,
        ],
        'ordered_traits' => [
            'case_sensitive' => true,
        ],
        'php_unit_data_provider_name' => [
            'prefix' => 'provide',
            'suffix' => 'Cases',
        ],
        'phpdoc_align' => [
            'align' => 'left',
            'spacing' => 1,
            'tags' => [
                'method',
                'param',
                'property',
                'property-read',
                'property-write',
                'return',
                'throws',
                'type',
                'var',
            ],
        ],
        'phpdoc_line_span' => [
            'const' => 'single',
            'method' => 'multi',
            'property' => 'single',
        ],
        'phpdoc_no_alias_tag' => [
            'replacements' => [
                'link' => 'see',
                'type' => 'var',
            ],
        ],
        'phpdoc_order' => [
            'order' => [
                'noinspection',
                'phan-suppress',
                'phpcsSuppress',
                'phpstan-ignore',
                'psalm-suppress',

                'deprecated',
                'internal',
                'covers',
                'uses',
                'dataProvider',
                'param',
                'throws',
                'return',
            ],
        ],
        'phpdoc_to_param_type' => [
            'scalar_types' => true,
            'types_map' => [],
            'union_types' => true,
        ],
        'phpdoc_to_property_type' => [
            'scalar_types' => true,
            'types_map' => [],
            'union_types' => true,
        ],
        'phpdoc_to_return_type' => [
            'scalar_types' => true,
            'types_map' => [],
            'union_types' => true,
        ],
        'simplified_if_return' => true,
        'simplified_null_return' => true,
        'single_line_empty_body' => true,
        'statement_indentation' => [
            'stick_comment_to_next_continuous_control_statement' => true,
        ],
        'static_lambda' => false, // pest
    ]));

$ruleSet->withCustomFixers(Fixers::fromFixers(
    ...array_filter(
        iterator_to_array(new PhpCsFixerCustomFixers\Fixers),
        static fn (AbstractFixer $fixer): bool => !$fixer instanceof DeprecatedFixerInterface
            && !\array_key_exists($fixer->getName(), $ruleSet->rules()->toArray())
    )
));

return Factory::fromRuleSet($ruleSet)
    ->setFinder(
        Finder::create()
            ->in([
                __DIR__.'/benchmarks/',
                __DIR__.'/src/',
                __DIR__.'/tests/',
            ])
            ->exclude([
                '__snapshots__',
                'Fixtures',
            ])
            ->append([
                ...array_filter(
                    glob(__DIR__.'/{*,.*}.php', \GLOB_BRACE),
                    static fn (string $filename): bool => !\in_array($filename, [
                        __DIR__.'/.phpstorm.meta.php',
                        // __DIR__.'/_ide_helper.php',
                        __DIR__.'/_ide_helper_models.php',
                    ], true)
                ),
                __DIR__.'/composer-updater',
                __DIR__.'/generate-ide-json',
                __DIR__.'/platform-lint',
            ])
    )
    ->setRiskyAllowed(true)
    ->setUsingCache(true)
    ->setParallelConfig(ParallelConfigFactory::detect())
    ->setCacheFile(__DIR__.'/.build/php-cs-fixer/.php-cs-fixer.cache');
