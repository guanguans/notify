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

use ShipMonk\ComposerDependencyAnalyser\Config\Configuration;
use ShipMonk\ComposerDependencyAnalyser\Config\ErrorType;

return (new Configuration)
    ->addPathsToScan(
        [
            __DIR__.'/src',
        ],
        false
    )
    ->addPathsToExclude([
        __DIR__.'/tests',
        __DIR__.'/src/Foundation/Rectors',
    ])
    ->ignoreUnknownClasses([
        // SensitiveParameter::class,
        'SensitiveParameter',
    ])
    /** @see \ShipMonk\ComposerDependencyAnalyser\Analyser::CORE_EXTENSIONS */
    ->ignoreErrorsOnExtensions(
        [
            'ext-ctype',
            'ext-curl',
            'ext-filter',
            'ext-mbstring',
        ],
        [ErrorType::SHADOW_DEPENDENCY]
    )
    ->ignoreErrorsOnPackages(
        [
            'guzzlehttp/promises',
            'guzzlehttp/psr7',
            'psr/http-factory',
            'psr/http-message',
        ],
        [ErrorType::SHADOW_DEPENDENCY]
    )
    ->ignoreErrorsOnPackageAndPath(
        'guanguans/ai-commit',
        __DIR__.'/src/Foundation/Support/Str.php',
        [ErrorType::DEV_DEPENDENCY_IN_PROD]
    )
    ->ignoreErrorsOnPackages(
        [
            'illuminate/collections',
            'illuminate/support',
            'symfony/var-dumper',
        ],
        [ErrorType::DEV_DEPENDENCY_IN_PROD]
    );
