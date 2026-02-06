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

use Guanguans\Notify\Foundation\Concerns\Dumpable;
use Guanguans\Notify\Foundation\Support\ComposerScripts;

arch('will not use debugging functions')
    // ->throwsNoExceptions()
    ->group(__DIR__, __FILE__)
    ->expect([
        'dd',
        'die',
        'dump',
        'echo',
        'env',
        'env_explode',
        'env_getcsv',
        'exit',
        'print',
        'print_r',
        'printf',
        'ray',
        'trap',
        'var_dump',
        'var_export',
        'vprintf',
    ])
    // ->each
    ->not->toBeUsed()
    ->ignoring([
        ComposerScripts::class,
        Dumpable::class,
    ]);
