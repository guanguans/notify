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

namespace Guanguans\NotifyTests\RocketChat;

use Guanguans\Notify\RocketChat\Authenticator;
use Guanguans\Notify\RocketChat\Client;
use Guanguans\Notify\RocketChat\Messages\Message;
use Psr\Http\Message\ResponseInterface;

it('can send message', function (): void {
    $authenticator = new Authenticator('https://guanguans.rocket.chat/hooks/65bf67eb387fb98fc8bcc245/fcN2v4EkkkaLM8wzgfSeEWD9ngjgLPBhspPPFhoM78Ww2');
    $client = new Client($authenticator);
    $message = Message::make([
        'alias' => '报警机器人',
        'emoji' => ':warning:',
        'text' => 'This is a text. ',
        // 'attachments' => [
        //     [
        //         'title' => 'This is a title.',
        //         'title_link' => 'https://rocket.chat',
        //         'text' => 'This is a text.',
        //         'image_url' => 'http://www.xxx.png',
        //         'color' => '#764FA5',
        //     ],
        // ],
    ]);

    expect($client)
        ->httpErrors(false)
        ->mock([
            create_response('{"success":true}'),
            create_response('{"success":false,"error":"Invalid integration id or token provided."}'),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);
