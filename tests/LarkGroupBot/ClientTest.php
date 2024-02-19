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

namespace Guanguans\NotifyTests\LarkGroupBot;

use Guanguans\Notify\LarkGroupBot\Authenticator;
use Guanguans\Notify\LarkGroupBot\Client;
use Guanguans\Notify\LarkGroupBot\Messages\CardMessage;
use Guanguans\Notify\LarkGroupBot\Messages\ImageMessage;
use Guanguans\Notify\LarkGroupBot\Messages\PostMessage;
use Guanguans\Notify\LarkGroupBot\Messages\ShareChatMessage;
use Guanguans\Notify\LarkGroupBot\Messages\TextMessage;
use Psr\Http\Message\ResponseInterface;

it('can send text message', function (): void {
    $authenticator = new Authenticator(
        '2504d7d6-356d-414e-9c99-cd5671d14',
        'WeqWRCyD9pawyIPGqldUYe'
    );
    $client = new Client($authenticator);
    $message = TextMessage::make()->text('This is text(keyword).');

    expect($client)
        ->httpErrors(false)
        ->mock([
            create_response('{"StatusCode":0,"StatusMessage":"success","code":0,"data":{},"msg":"success"}'),
            create_response('{"code":19001,"data":{},"msg":"param invalid: incoming webhook access token invalid"}'),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);

it('can send card message', function (): void {
    $authenticator = new Authenticator(
        '2504d7d6-356d-414e-9c99-cd5671d14',
        'WeqWRCyD9pawyIPGqldUYe'
    );
    $client = new Client($authenticator);
    $message = CardMessage::make()->card([
        'elements' => [
            [
                'tag' => 'div',
                'text' => [
                    'content' => 'This is content.',
                    'tag' => 'lark_md',
                ],
            ],
        ],
    ]);

    expect($client)
        ->httpErrors(false)
        ->mock([
            create_response('{"StatusCode":0,"StatusMessage":"success","code":0,"data":{},"msg":"success"}'),
            create_response('{"code":19001,"data":{},"msg":"param invalid: incoming webhook access token invalid"}'),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);

it('can send image message', function (): void {
    $authenticator = new Authenticator(
        '2504d7d6-356d-414e-9c99-cd5671d14',
        'WeqWRCyD9pawyIPGqldUYe'
    );
    $client = new Client($authenticator);
    $message = ImageMessage::make()->imageKey('img_ecffc3b9-8f14-400f-a014-05eca1a4');

    expect($client)
        ->httpErrors(false)
        ->mock([
            create_response('{"StatusCode":0,"StatusMessage":"success","code":0,"data":{},"msg":"success"}'),
            create_response('{"code":19001,"data":{},"msg":"param invalid: incoming webhook access token invalid"}'),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);

it('can send post message', function (): void {
    $authenticator = new Authenticator(
        '2504d7d6-356d-414e-9c99-cd5671d14',
        'WeqWRCyD9pawyIPGqldUYe'
    );
    $client = new Client($authenticator);
    $message = PostMessage::make()->post([
        'zh_cn' => [
            'title' => '项目更新通知',
            'content' => [
                [
                    [
                        'tag' => 'text',
                        'text' => '项目有更新(keyword)',
                    ],
                ],
            ],
        ],
    ]);

    expect($client)
        ->httpErrors(false)
        ->mock([
            create_response('{"StatusCode":0,"StatusMessage":"success","code":0,"data":{},"msg":"success"}'),
            create_response('{"code":19001,"data":{},"msg":"param invalid: incoming webhook access token invalid"}'),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);

it('can send share chat message', function (): void {
    $authenticator = new Authenticator(
        '2504d7d6-356d-414e-9c99-cd5671d14',
        'WeqWRCyD9pawyIPGqldUYe'
    );
    $client = new Client($authenticator);
    $message = ShareChatMessage::make()->shareChatId('oc_f5b1a7eb27ae2c7b6adc2a74faf');

    expect($client)
        ->httpErrors(false)
        ->mock([
            create_response('{"StatusCode":0,"StatusMessage":"success","code":0,"data":{},"msg":"success"}'),
            create_response('{"code":19001,"data":{},"msg":"param invalid: incoming webhook access token invalid"}'),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);
