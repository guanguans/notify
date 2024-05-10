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

namespace Guanguans\NotifyTests\AnPush;

use Guanguans\Notify\AnPush\Authenticator;
use Guanguans\Notify\AnPush\Client;
use Guanguans\Notify\AnPush\Messages\Message;

it('can send message', function (): void {
    $authenticator = new Authenticator('FE3LGGYQZXRZ6A50BN66M42H0BY');
    $client = new Client($authenticator);
    $message = Message::make([
        'title' => 'This is title.',
        'content' => 'This is content.',
        'channel' => '94412',
        // 'to' => 'ov_1i8jk39d****',
    ]);

    expect($client)
        ->mock([
            create_response('{"msg":"success","code":200,"data":{"msgIds":[{"channelId":"94412","msgId":1715333937401}]}}'),
            create_response('{"msg":"Token not found","code":10006}'),
        ])
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);
