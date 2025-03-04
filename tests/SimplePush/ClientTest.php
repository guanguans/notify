<?php

/** @noinspection AnonymousFunctionStaticInspection */
/** @noinspection PhpPossiblePolymorphicInvocationInspection */
/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection StaticClosureCanBeUsedInspection */

declare(strict_types=1);

/**
 * Copyright (c) 2021-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\NotifyTests\SimplePush;

use Guanguans\Notify\SimplePush\Authenticator;
use Guanguans\Notify\SimplePush\Client;
use Guanguans\Notify\SimplePush\Messages\Message;

it('can send message', function (): void {
    $authenticator = new Authenticator('tw8xxx');
    $client = new Client($authenticator);
    $message = Message::make([
        'msg' => 'This is message.',
        'title' => 'This is title.',
        'event' => 'This is event.',
        'actions' => [
            [
                'name' => 'notify',
                'url' => 'https://github.com/guanguans/notify',
            ],
            [
                'name' => 'laravel-exception-notify',
                'url' => 'https://github.com/guanguans/laravel-exception-notify',
            ],
        ],
        'attachments' => [
            'https://raw.githubusercontent.com/guanguans/notify/main/tests/Fixtures/image.png',
        ],
    ]);

    expect($client)
        ->mock([
            response('{"status":"OK"}'),
            response('', 406),
        ])
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);
