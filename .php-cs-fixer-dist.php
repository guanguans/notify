<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2024 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

use Ergebnis\License;
use Ergebnis\PhpCsFixer\Config;

$license = License\Type\MIT::text(
    __DIR__.'/LICENSE',
    License\Range::since(
        License\Year::fromString('2021'),
        new DateTimeZone('Asia/Shanghai'),
    ),
    License\Holder::fromString('guanguans<ityaozm@gmail.com>'),
    License\Url::fromString('https://github.com/guanguans/notify'),
);

$license->save();

$ruleSet = Config\RuleSet\Php74::create()
    ->withHeader($license->header())
    ->withRules(Config\Rules::fromArray([
        '@PHP70Migration' => true,
        '@PHP70Migration:risky' => true,
        '@PHP71Migration' => true,
        '@PHP71Migration:risky' => true,
        '@PHP73Migration' => true,
        '@PHP74Migration' => true,
        '@PHP74Migration:risky' => true,
        // '@PHP80Migration' => true,
        // '@PHP80Migration:risky' => true,
        // '@PHP81Migration' => true,
        // '@PHP82Migration' => true,
        // '@PHP83Migration' => true,

        // '@PHPUnit75Migration:risky' => true,
        // '@PHPUnit84Migration:risky' => true,
        // '@PHPUnit100Migration:risky' => true,

        // '@DoctrineAnnotation' => true,
        // '@PhpCsFixer' => true,
        // '@PhpCsFixer:risky' => true,

        'explicit_string_variable' => false,
        'final_class' => false,
        'logical_operators' => false,
        'mb_str_functions' => false,
        'single_line_empty_body' => true,
        'static_lambda' => false, // pest
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
        'concat_space' => [
            'spacing' => 'none',
        ],
        'class_definition' => [
            'inline_constructor_arguments' => false,
            'multi_line_extends_each_single_line' => false,
            'single_item_single_line' => false,
            'single_line' => false,
            'space_before_parenthesis' => false,
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
        'phpdoc_no_alias_tag' => [
            'replacements' => [
                'link' => 'see',
                'type' => 'var',
            ],
        ],
        'new_with_parentheses' => [
            'anonymous_class' => false,
            'named_class' => false,
        ],
        'no_extra_blank_lines' => [
            'tokens' => [
                'break',
                'case',
                'continue',
                'curly_brace_block',
                'default',
                'extra',
                'parenthesis_brace_block',
                'return',
                'square_brace_block',
                'switch',
                'throw',
                // 'use',
            ],
        ],
        'native_function_invocation' => [
            'include' => ['@compiler_optimized', 'is_scalar'],
            'exclude' => [],
            'scope' => 'namespaced',
            'strict' => true,
        ],
    ]));

$config = Config\Factory::fromRuleSet($ruleSet);

$config->getFinder()
    ->in(__DIR__)
    ->exclude([
        '.build/',
        '.chglog/',
        '.github/',
        'build/',
        'docs/',
        'vendor/',
        '__snapshots__/',
    ])
    ->append(glob(__DIR__.'/{*,.*}.php', \GLOB_BRACE))
    ->append([
        __DIR__.'/composer-updater',
        __DIR__.'/platform-lint',
    ])
    ->notPath([
        'bootstrap/*',
        'storage/*',
        'resources/view/mail/*',
        'vendor/*',
    ])
    ->name('*.php')
    ->notName([
        '*.blade.php',
        // '_ide_helper.php',
    ])
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$config
    ->setRiskyAllowed(true)
    ->setUsingCache(true)
    ->setCacheFile(__DIR__.'/.build/php-cs-fixer/.php-cs-fixer.cache');

return $config;
