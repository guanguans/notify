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

namespace Guanguans\NotifyTests\WPush;

use Guanguans\Notify\WPush\Authenticator;
use Guanguans\Notify\WPush\Client;
use Guanguans\Notify\WPush\Messages\Message;

it('can send message', function (): void {
    $authenticator = new Authenticator('WPUSHXtvzuCujtOcL1cFkF1NC9aef');
    $client = new Client($authenticator);
    $message = Message::make([
        'title' => 'This is title.',
        'content' => 'This is content.',
        'channel' => 'wechat',
        // 'topic_code' => 'topic_code',
    ]);

    expect($client)
        ->mock([
            create_response('{"code":0,"message":"success","data":"50285451654725632"}'),
            create_response('{"code":401,"message":"API Key错误","data":null}'),
        ])
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);
