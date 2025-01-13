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

use Rector\Config\RectorConfig;
use Rector\Php82\Rector\Param\AddSensitiveParameterAttributeRector;
use Rector\ValueObject\PhpVersion;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->importNames(false, false);
    $rectorConfig->importShortClasses(false);
    $rectorConfig->parallel(240);
    // $rectorConfig->disableParallel();
    $rectorConfig->phpstanConfig(__DIR__.'/phpstan.neon');
    $rectorConfig->phpVersion(PhpVersion::PHP_82);

    $rectorConfig->paths([
        __DIR__.'/src/*/Authenticator.php',
        __DIR__.'/src/*/*/*Authenticator.php',
    ]);

    $rectorConfig->skip([
        __DIR__.'/src/Foundation/Support',
        __DIR__.'/src/Foundation/Response.php',
    ]);

    $rectorConfig->ruleWithConfiguration(AddSensitiveParameterAttributeRector::class, [
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
    ]);
};
