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
use Ergebnis\PhpCsFixer;
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
        // '@PHP70Migration' => true,
        // '@PHP70Migration:risky' => true,
        // '@PHP71Migration' => true,
        // '@PHP71Migration:risky' => true,
        // '@PHP73Migration' => true,
        // '@PHP74Migration' => true,
        // '@PHP74Migration:risky' => true,
        // // '@PHP80Migration' => true,
        // // '@PHP80Migration:risky' => true,
        // // '@PHP81Migration' => true,
        // // '@PHP82Migration' => true,
        //
        // // '@PHPUnit75Migration:risky' => true,
        // // '@PHPUnit84Migration:risky' => true,
        // // '@PHPUnit100Migration:risky' => true,
        //
        // // '@DoctrineAnnotation' => true,
        // '@PhpCsFixer' => true,
        // '@PhpCsFixer:risky' => true,

        'final_class' => false,
        'explicit_string_variable' => false,
        'single_line_empty_body' => true,
        'logical_operators' => false,
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
        'concat_space' => [
            'spacing' => 'none',
        ],
        'mb_str_functions' => false,
        'static_lambda' => false, // pest

        // todo
        'trailing_comma_in_multiline' => false,
        'native_constant_invocation' => false,
        'phpdoc_list_type' => false,
        'phpdoc_order' => false,
        'final_public_method_for_abstract_class' => false,
        'blank_line_before_statement' => false,
        'unary_operator_spaces' => false,
        'native_function_invocation' => false,
        'no_blank_lines_after_phpdoc' => false,
        'final_internal_class' => false,
        'phpdoc_order_by_value' => false,
        'class_attributes_separation' => false,
        'no_extra_blank_lines' => false,
        'PhpCsFixerCustomFixers/no_duplicated_array_key' => false,
        'class_definition' => false,
        'no_trailing_comma_in_singleline' => false,
        'phpdoc_summary' => false,
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
    ->append(glob(__DIR__.'/{*,.*}.php', GLOB_BRACE))
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
