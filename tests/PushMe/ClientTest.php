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

use Guanguans\Notify\PushMe\Authenticator;
use Guanguans\Notify\PushMe\Client;
use Guanguans\Notify\PushMe\Messages\Message;

it('can send message', function (): void {
    $authenticator = new Authenticator(
        'uhDXKk3UXJtdT3dE6',
        // 'hLzPCm6Y1y26iddAy'
    );
    $client = new Client($authenticator);
    $message = Message::make([
        // 'push_key' => 'uhDXKk3UXJtdT3dE6',
        // 'temp_key' => 'hLzPCm6Y1y26iddAy',
        'title' => 'This is title.',
        'content' => '> This is content.',
        'date' => date('Y-m-d H:i:s'),
        'type' => 'markdown',
    ]);

    expect($client)
        ->mock([
            response('success'),
            response('请检查push_key是否正确'),
        ])
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);
