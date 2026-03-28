<?php

/** @noinspection AnonymousFunctionStaticInspection */
/** @noinspection NullPointerExceptionInspection */
/** @noinspection PhpFieldAssignmentTypeMismatchInspection */
/** @noinspection PhpPossiblePolymorphicInvocationInspection */
/** @noinspection PhpUndefinedClassInspection */
/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection PhpVoidFunctionResultUsedInspection */
/** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

use Guanguans\Notify\Foundation\Authenticators\WsseAuthenticator;
use Guanguans\Notify\Foundation\Caches\FileCache;
use Guanguans\Notify\Foundation\Concerns\Dumpable;
use Guanguans\Notify\Foundation\Support\ComposerScripts;

arch()
    ->group(__DIR__, __FILE__)
    // ->skip()
    ->preset()->php()->ignoring([
        Dumpable::class,
    ]);

arch()
    ->group(__DIR__, __FILE__)
    ->skip()
    ->preset()->laravel()->ignoring([
        ComposerScripts::class,
        Dumpable::class,
    ]);

arch()
    ->group(__DIR__, __FILE__)
    // ->skip()
    ->preset()->security()->ignoring([
        'assert',
        FileCache::class,
        WsseAuthenticator::class,
    ]);

arch()
    ->group(__DIR__, __FILE__)
    ->skip()
    ->preset()->strict()->ignoring([
    ]);

arch()
    ->group(__DIR__, __FILE__)
    ->skip()
    ->preset()->relaxed()->ignoring([
    ]);

arch('will not use debugging functions')
    ->group(__DIR__, __FILE__)
    // ->throwsNoExceptions()
    // ->skip()
    ->expect([
        // 'dd',
        'env',
        'env_explode',
        'env_getcsv',
        'exit',
        'printf',
        'vprintf',
    ])
    // ->each
    ->not->toBeUsed()
    ->ignoring([
        ComposerScripts::class,
        Dumpable::class,
    ]);
