<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$header = <<<EOF
This file is part of the guanguans/notify.

(c) guanguans <ityaozm@gmail.com>

This source file is subject to the MIT license that is bundled.
EOF;

/** @noinspection PhpParamsInspection */
$finder = Finder::create()
    ->in([
        // __DIR__.'/benchmarks',
        __DIR__.'/src',
        __DIR__.'/tests',
    ])
    ->exclude([
        '.github/',
        'doc/',
        'docs/',
        'vendor/',
        '__snapshots__/',
    ])
    ->append(glob(__DIR__.'/{*,.*}.php', GLOB_BRACE))
    ->append([
        __DIR__.'/composer-fixer',
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
        '_ide_helper.php',
    ])
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return (new Config())
    ->setRules([
        '@DoctrineAnnotation' => true,
        // '@PHP80Migration:risky' => true,
        '@PHPUnit84Migration:risky' => true,
        '@PSR12:risky' => true,
        '@Symfony' => true,
        'header_comment' => [
            'header' => $header,
            'comment_type' => 'PHPDoc',
        ],
        'blank_line_before_statement' => [
            'statements' => ['break', 'continue', 'declare', 'return', 'throw', 'try'],
        ],
        'comment_to_phpdoc' => [
            'ignored_tags' => [],
        ],
        'declare_strict_types' => true,
        'method_argument_space' => [
            'on_multiline' => 'ensure_fully_multiline',
        ],
        'not_operator_with_successor_space' => true,
        'no_useless_return' => true,
        'no_useless_else' => true,
        'is_null' => true,
        'return_assignment' => true,
        'multiline_comment_opening_closing' => true,
        'align_multiline_comment' => [
            'comment_type' => 'phpdocs_only',
        ],
        'phpdoc_to_comment' => [],
        'phpdoc_var_annotation_correct_order' => true,
        'php_unit_construct' => [
            'assertions' => ['assertEquals', 'assertSame', 'assertNotEquals', 'assertNotSame'],
        ],
        'array_indentation' => true,
        'method_chaining_indentation' => true,
        // 'statement_indentation' => true,
        // 'phpdoc_separation' => [['method', 'description']],
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder);
