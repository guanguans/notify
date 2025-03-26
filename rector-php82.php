<?php

/** @noinspection PhpInternalEntityUsedInspection */

declare(strict_types=1);

/**
 * Copyright (c) 2021-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

use Guanguans\Notify\Foundation\Rectors\HasHttpClientDocCommentRector;
use Guanguans\Notify\Foundation\Rectors\HasOptionsDocCommentRector;
use Guanguans\Notify\Foundation\Rectors\ToInternalExceptionRector;
use Rector\Config\RectorConfig;
use Rector\Php82\Rector\Param\AddSensitiveParameterAttributeRector;
use Rector\ValueObject\PhpVersion;

return RectorConfig::configure()
    ->withPaths([
        __DIR__.'/src/',
        __DIR__.'/src/*/Authenticator.php',
        __DIR__.'/src/*/*/*Authenticator.php',
    ])
    ->withSkip([
        __DIR__.'/src/Foundation/Support',
        __DIR__.'/src/Foundation/Response.php',
    ])
    ->withPhpVersion(PhpVersion::PHP_82)
    ->withRules([
        HasHttpClientDocCommentRector::class,
        HasOptionsDocCommentRector::class,
        ToInternalExceptionRector::class,
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
    ]);
