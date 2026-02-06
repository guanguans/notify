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

use Guanguans\Notify\GoogleChat\Authenticator;
use Guanguans\Notify\GoogleChat\Client;
use Guanguans\Notify\GoogleChat\Messages\Message;

it('can send message', function (): void {
    $authenticator = new Authenticator('spaceId', 'key', 'token', 'threadKey');
    $client = new Client($authenticator);
    $message = Message::make([
        'text' => 'This is text.',
    ]);

    expect($client)
        ->mock([
            response(fake()->text()),
        ])
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);
