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

namespace Guanguans\NotifyTests\Chanify;

use Guanguans\Notify\Chanify\Authenticator;
use Guanguans\Notify\Chanify\Client;
use Guanguans\Notify\Chanify\Messages\AudioMessage;
use Guanguans\Notify\Chanify\Messages\FileMessage;
use Guanguans\Notify\Chanify\Messages\ImageMessage;
use Guanguans\Notify\Chanify\Messages\LinkMessage;
use Guanguans\Notify\Chanify\Messages\TextMessage;

beforeEach(function (): void {
    $authenticator = new Authenticator('CICwhbIGEiJBQVdIWlVKS1JORVY0UlVETFZYVVpRTlNLTlVZVlZPT1JFIgIIAQ.orHlBVavQPrY-ZP3eqQKDgjyTtNdZPdNYV6lpAx8');
    $this->client = (new Client($authenticator))->mock([
        create_response('{"request-uid":"03fe6123-2098-4af8-a210-658010a69d9c"}'),
        create_response('{"res":400,"msg":"bad request"}', 400),
    ]);
});

it('can send text message', function (): void {
    $textMessage = TextMessage::make([
        'title' => 'This is title.',
        'text' => 'This is text.',
        'copy' => 'This is copy.',
        'autocopy' => 1,
        'sound' => 'bell',
        'priority' => 5,
        'interruptionlevel' => 'active',
        'actions' => [
            'ActionName1|http://<action host>/<action1>',
            'ActionName2|http://<action host>/<action2>',
        ],
        'timeline' => [
            'code' => '<timeline code>',
            'timestamp' => 1620000000000,
            'items' => [
                'key1' => 'value1',
                'key2' => 'value2',
            ],
        ],
    ]);

    expect($this->client)->assertCanSendMessage($textMessage);
})->group(__DIR__, __FILE__);

it('can send audio message', function (): void {
    $audioMessage = AudioMessage::make()->audio('This is audio path.');

    expect($this->client)->assertCanSendMessage($audioMessage);
})->group(__DIR__, __FILE__);

it('can send file message', function (): void {
    $fileMessage = FileMessage::make()->file('This is file path.');

    expect($this->client)->assertCanSendMessage($fileMessage);
})->group(__DIR__, __FILE__);

it('can send image message', function (): void {
    $imageMessage = ImageMessage::make()->image('This is image path.');

    expect($this->client)->assertCanSendMessage($imageMessage);
})->group(__DIR__, __FILE__);

it('can send link message', function (): void {
    $linkMessage = LinkMessage::make([
        'link' => 'https://github.com/guanguans/notify',
        'sound' => 1,
        'priority' => 10,
    ]);

    expect($this->client)->assertCanSendMessage($linkMessage);
})->group(__DIR__, __FILE__);
