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

namespace Guanguans\NotifyTests\Lark;

use Guanguans\Notify\Lark\Authenticator;
use Guanguans\Notify\Lark\Client;
use Guanguans\Notify\Lark\Messages\CardMessage;
use Guanguans\Notify\Lark\Messages\ImageMessage;
use Guanguans\Notify\Lark\Messages\PostMessage;
use Guanguans\Notify\Lark\Messages\ShareChatMessage;
use Guanguans\Notify\Lark\Messages\TextMessage;

beforeEach(function (): void {
    $authenticator = new Authenticator(
        '2504d7d6-356d-414e-9c99-cd5671d14',
        'WeqWRCyD9pawyIPGqldUYe',
    );
    $this->client = (new Client($authenticator))->mock([
        create_response('{"StatusCode":0,"StatusMessage":"success","code":0,"data":{},"msg":"success"}'),
        create_response('{"code":19001,"data":{},"msg":"param invalid: incoming webhook access token invalid"}'),
    ]);
});

it('can send text message', function (): void {
    $textMessage = TextMessage::make()->text('This is text(keyword).');

    expect($this->client)->assertCanSendMessage($textMessage);
})->group(__DIR__, __FILE__);

it('can send card message', function (): void {
    $cardMessage = CardMessage::make([
        'elements' => [
            [
                'tag' => 'div',
                'text' => [
                    'tag' => 'plain_text',
                    'content' => 'This is content.',
                ],
            ],
        ],
    ]);

    expect($this->client)->assertCanSendMessage($cardMessage);
})->group(__DIR__, __FILE__);

it('can send image message', function (): void {
    $imageMessage = ImageMessage::make()->imageKey('img_ecffc3b9-8f14-400f-a014-05eca1a4');

    expect($this->client)->assertCanSendMessage($imageMessage);
})->group(__DIR__, __FILE__);

it('can send post message', function (): void {
    $postMessage = PostMessage::make(
        [
            'zh_cn' => $post = [
                'title' => 'This is title(keyword).',
                'content' => [
                    [
                        ['tag' => 'text', 'text' => 'This is text 1.'],
                        ['tag' => 'text', 'text' => 'This is text 2.'],
                    ],
                ],
            ],
        ],
    )
        ->post(['zh_cn' => $post])
        ->setPostForLang('en_us', $post);

    expect($this->client)->assertCanSendMessage($postMessage);
})->group(__DIR__, __FILE__);

it('can send share chat message', function (): void {
    $shareChatMessage = ShareChatMessage::make()->shareChatId('oc_f5b1a7eb27ae2c7b6adc2a74faf');

    expect($this->client)->assertCanSendMessage($shareChatMessage);
})->group(__DIR__, __FILE__);
