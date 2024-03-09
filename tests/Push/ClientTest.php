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

namespace Guanguans\NotifyTests\Push;

use Guanguans\Notify\Push\Authenticator;
use Guanguans\Notify\Push\Client;
use Guanguans\Notify\Push\Messages\AsyncMessage;
use Guanguans\Notify\Push\Messages\GroupMessage;
use Guanguans\Notify\Push\Messages\Message;

beforeEach(function (): void {
    $authenticator = new Authenticator('5db80e8a-1f9b-4f98-929a-75892cedc');
    $this->client = (new Client($authenticator))->mock([
        create_response('{"success":true,"responses":[{"success":true,"message":"Message send to device"},{"success":true,"message":"Message send to device"}]}'),
        create_response('{"success":false,"message":"Invalid API key, authentication failed"}', 401),
    ]);
});

it('can send message', function (): void {
    $message = Message::make([
        'title' => 'This is title.',
        'body' => 'This is body.',
        'sound' => 'fail',
        'channel' => 'this-is-channel',
        'link' => 'https://github.com/guanguans/notify',
        'image' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        'timeSensitive' => true,
    ]);

    expect($this->client)->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);

it('can send async message', function (): void {
    $asyncMessage = AsyncMessage::make([
        'title' => 'This is title.',
        'body' => 'This is body.',
        'sound' => 'fail',
        'channel' => 'this-is-channel',
        'link' => 'https://github.com/guanguans/notify',
        'image' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        'timeSensitive' => true,
    ]);

    expect($this->client)->assertCanSendMessage($asyncMessage);
})->group(__DIR__, __FILE__);

it('can send group message', function (): void {
    $groupMessage = GroupMessage::make([
        'groupId' => 'group-name',
        'title' => 'This is title.',
        'body' => 'This is body.',
        'sound' => 'fail',
        'channel' => 'this-is-channel',
        'link' => 'https://github.com/guanguans/notify',
        'image' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        'timeSensitive' => true,
    ]);

    expect($this->client)->assertCanSendMessage($groupMessage);
})->group(__DIR__, __FILE__);
