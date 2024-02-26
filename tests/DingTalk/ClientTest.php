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

namespace Guanguans\NotifyTests\DingTalk;

use Guanguans\Notify\DingTalk\Authenticator;
use Guanguans\Notify\DingTalk\Client;
use Guanguans\Notify\DingTalk\Messages\BtnsActionCardMessage;
use Guanguans\Notify\DingTalk\Messages\FeedCardMessage;
use Guanguans\Notify\DingTalk\Messages\LinkMessage;
use Guanguans\Notify\DingTalk\Messages\MarkdownMessage;
use Guanguans\Notify\DingTalk\Messages\SingleActionCardMessage;
use Guanguans\Notify\DingTalk\Messages\TextMessage;
use Psr\Http\Message\ResponseInterface;

it('can send text message', function (): void {
    $authenticator = new Authenticator(
        'c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73',
        'SECc32bb7345c0f73da2b9786f0f7dd5083bd768a29b82e6d460149d730eee51730'
    );
    $client = new Client($authenticator);
    $message = TextMessage::make([
        'content' => 'This is content(keyword).',
        // 'atMobiles' => [13948484984],
        // 'atDingtalkIds' => [123456],
        // 'isAtAll'   => false,
    ]);

    expect($client)
        ->mock([
            create_response('{"errcode":0,"errmsg":"ok"}'),
            create_response('{"errcode":300005,"errmsg":"token is not exist"}'),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);

it('can send btns action card message', function (): void {
    $authenticator = new Authenticator(
        'c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73',
        'SECc32bb7345c0f73da2b9786f0f7dd5083bd768a29b82e6d460149d730eee51730'
    );
    $client = new Client($authenticator);
    $message = BtnsActionCardMessage::make([
        'title' => 'This is title(keyword).',
        'text' => 'This is text.',
        // 'hideAvatar'     => 1,
        // 'btnOrientation' => 1,
        'btns' => [
            [
                'title' => 'This is title 1',
                'actionURL' => 'https://github.com/guanguans/notify',
            ],
        ],
    ]);

    expect($client)
        ->mock([
            create_response('{"errcode":0,"errmsg":"ok"}'),
            create_response('{"errcode":300005,"errmsg":"token is not exist"}'),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);

it('can send feed card message', function (): void {
    $authenticator = new Authenticator(
        'c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73',
        'SECc32bb7345c0f73da2b9786f0f7dd5083bd768a29b82e6d460149d730eee51730'
    );
    $client = new Client($authenticator);
    $message = FeedCardMessage::make()->links([
        [
            'title' => 'This is title(keyword) 0.',
            'messageURL' => 'https://github.com/guanguans/notify',
            'picURL' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        ],
    ]);

    expect($client)
        ->mock([
            create_response('{"errcode":0,"errmsg":"ok"}'),
            create_response('{"errcode":300005,"errmsg":"token is not exist"}'),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);

it('can send link message', function (): void {
    $authenticator = new Authenticator(
        'c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73',
        'SECc32bb7345c0f73da2b9786f0f7dd5083bd768a29b82e6d460149d730eee51730'
    );
    $client = new Client($authenticator);
    $message = LinkMessage::make([
        'title' => 'This is content.',
        'text' => 'This is text(keyword).',
        'messageUrl' => 'https://github.com/guanguans/notify',
        'picUrl' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
    ]);

    expect($client)
        ->mock([
            create_response('{"errcode":0,"errmsg":"ok"}'),
            create_response('{"errcode":300005,"errmsg":"token is not exist"}'),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);

it('can send markdown message', function (): void {
    $authenticator = new Authenticator(
        'c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73',
        'SECc32bb7345c0f73da2b9786f0f7dd5083bd768a29b82e6d460149d730eee51730'
    );
    $client = new Client($authenticator);
    $message = MarkdownMessage::make([
        'title' => 'This is title.',
        'text' => '> This is text(keyword).',
        // 'atMobiles' => [13948484984],
        // 'atDingtalkIds' => [123456],
        // 'isAtAll'   => false,
    ]);

    expect($client)
        ->mock([
            create_response('{"errcode":0,"errmsg":"ok"}'),
            create_response('{"errcode":300005,"errmsg":"token is not exist"}'),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);

it('can send single action card message', function (): void {
    $authenticator = new Authenticator(
        'c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73',
        'SECc32bb7345c0f73da2b9786f0f7dd5083bd768a29b82e6d460149d730eee51730'
    );
    $client = new Client($authenticator);
    $message = SingleActionCardMessage::make([
        'title' => 'This is title(keyword).',
        'text' => 'This is text.',
        'singleTitle' => 'This is singleTitle.',
        'singleURL' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        // 'btnOrientation' => 1
    ]);

    expect($client)
        ->mock([
            create_response('{"errcode":0,"errmsg":"ok"}'),
            create_response('{"errcode":300005,"errmsg":"token is not exist"}'),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);
