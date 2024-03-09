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

namespace Guanguans\NotifyTests\DingTalk;

use Guanguans\Notify\DingTalk\Authenticator;
use Guanguans\Notify\DingTalk\Client;
use Guanguans\Notify\DingTalk\Messages\BtnsActionCardMessage;
use Guanguans\Notify\DingTalk\Messages\FeedCardMessage;
use Guanguans\Notify\DingTalk\Messages\LinkMessage;
use Guanguans\Notify\DingTalk\Messages\MarkdownMessage;
use Guanguans\Notify\DingTalk\Messages\SingleActionCardMessage;
use Guanguans\Notify\DingTalk\Messages\TextMessage;

beforeEach(function (): void {
    $authenticator = new Authenticator(
        'c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73',
        'SECc32bb7345c0f73da2b9786f0f7dd5083bd768a29b82e6d460149d730eee51730',
    );
    $this->client = (new Client($authenticator))->mock([
        create_response('{"errcode":0,"errmsg":"ok"}'),
        create_response('{"errcode":300005,"errmsg":"token is not exist"}'),
    ]);
});

it('can send text message', function (): void {
    $textMessage = TextMessage::make([
        'content' => 'This is content(keyword).',
        'atMobiles' => [13948484984],
        'atDingtalkIds' => [123456],
        'isAtAll' => false,
    ]);

    expect($this->client)->assertCanSendMessage($textMessage);
})->group(__DIR__, __FILE__);

it('can send btns action card message', function (): void {
    $btnsActionCardMessage = BtnsActionCardMessage::make([
        'title' => 'This is title(keyword).',
        'text' => 'This is text.',
        'btnOrientation' => 1,
        'btns' => [
            [
                'title' => 'This is title 1.',
                'actionURL' => 'https://github.com/guanguans/notify',
            ],
            [
                'title' => 'This is title 2.',
                'actionURL' => 'https://github.com/guanguans/notify',
            ],
        ],
    ])->addBtn([
        'title' => 'This is title 3.',
        'actionURL' => 'https://github.com/guanguans/notify',
    ]);

    expect($this->client)->assertCanSendMessage($btnsActionCardMessage);
})->group(__DIR__, __FILE__);

it('can send feed card message', function (): void {
    $feedCardMessage = FeedCardMessage::make()->links([
        [
            'title' => 'This is title(keyword) 1.',
            'messageURL' => 'https://github.com/guanguans/notify',
            'picURL' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        ],
        [
            'title' => 'This is title(keyword) 2.',
            'messageURL' => 'https://github.com/guanguans/notify',
            'picURL' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        ],
    ])->addLink([
        'title' => 'This is title(keyword) 3.',
        'messageURL' => 'https://github.com/guanguans/notify',
        'picURL' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
    ]);

    expect($this->client)->assertCanSendMessage($feedCardMessage);
})->group(__DIR__, __FILE__);

it('can send link message', function (): void {
    $linkMessage = LinkMessage::make([
        'title' => 'This is title.',
        'text' => 'This is text(keyword).',
        'messageUrl' => 'https://github.com/guanguans/notify',
        'picUrl' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
    ]);

    expect($this->client)->assertCanSendMessage($linkMessage);
})->group(__DIR__, __FILE__);

it('can send markdown message', function (): void {
    $markdownMessage = MarkdownMessage::make([
        'title' => 'This is title.',
        'text' => '> This is text(keyword).',
        'atMobiles' => [13948484984],
        'atDingtalkIds' => [123456],
        'isAtAll' => false,
    ]);

    expect($this->client)->assertCanSendMessage($markdownMessage);
})->group(__DIR__, __FILE__);

it('can send single action card message', function (): void {
    $singleActionCardMessage = SingleActionCardMessage::make([
        'title' => 'This is title(keyword).',
        'text' => 'This is text.',
        'singleTitle' => 'This is singleTitle.',
        'singleURL' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        'btnOrientation' => 1,
    ]);

    expect($this->client)->assertCanSendMessage($singleActionCardMessage);
})->group(__DIR__, __FILE__);
