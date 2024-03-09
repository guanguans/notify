<?php

/** @noinspection StaticClosureCanBeUsedInspection */
/** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

/**
 * Copyright (c) 2021-2024 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\NotifyTests\ShowdocPush;

use Guanguans\Notify\ShowdocPush\Authenticator;
use Guanguans\Notify\ShowdocPush\Client;
use Guanguans\Notify\ShowdocPush\Messages\Message;

it('can send message', function (): void {
    $authenticator = new Authenticator('f096edb95f92540219a41e47060eeb6d946199');
    $client = new Client($authenticator);
    $message = Message::make([
        'title' => 'This is title.',
        'content' => 'This is content.',
    ]);

    expect($client)
        ->mock([
            create_response('{"error_code":0,"error_message":"ok"}'),
            create_response('{"error_code":10103,"error_message":"url\u6216token\u4e0d\u6b63\u786e"}'),
        ])
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);
