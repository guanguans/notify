<?php

/** @noinspection StaticClosureCanBeUsedInspection */
/** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\NotifyTests\QQ;

use Guanguans\Notify\QQ\Authenticator;
use Guanguans\Notify\QQ\Client;
use Guanguans\Notify\QQ\Messages\Message;

it('can send message', function (): void {
    $authenticator = new Authenticator(
        '102001750',
        'eghXYBXQH0QXBByb8Zj4VeRGterQG',
    );
    $client = new Client($authenticator);
    $message = Message::make([
        'channel_id' => '4316959',
        'content' => 'This is content.',
        'embed' => [],
        'ark' => [],
        'message_reference' => [],
        'image' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        'file_image' => 'tests/fixtures/image.png',
        'msg_id' => 'This is msg id.',
        // 'event_id' => 'This is event id.',
        'markdown' => [],
    ]);

    expect($client)
        ->mock([
            create_response('{"id":"08efdfa1b3e1d4d6e246109fbe8702383048e4d0ccae06","channel_id":"4316959","guild_id":"5099581822453968879","content":"This is content.","timestamp":"2024-02-19T18:07:32+08:00","tts":false,"mention_everyone":false,"author":{"id":"7938900097687957410","username":"","avatar":"","bot":true},"pinned":false,"type":0,"flags":0,"seq_in_channel":"48"}'),
            create_response('{"message":"Token错误","code":11243,"err_code":40012002,"trace_id":"b363de10b4c8893a382b8b9d6d07c615"}', 401),
        ])
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);
