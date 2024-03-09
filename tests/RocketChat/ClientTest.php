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

namespace Guanguans\NotifyTests\RocketChat;

use Guanguans\Notify\RocketChat\Authenticator;
use Guanguans\Notify\RocketChat\Client;
use Guanguans\Notify\RocketChat\Messages\Message;

it('can send message', function (): void {
    $authenticator = new Authenticator('https://guanguans.rocket.chat/hooks/65bf67eb387fb98fc8bcc245/fcN2v4EkkkaLM8wzgfSeEWD9ngjgLPBhspPPFhoM78Ww2');
    $client = new Client($authenticator);
    $message = Message::make([
        // 'roomId' => 'Xnb2kLD2Pnhdwe3RH',
        // 'channel' => '#general',
        'text' => 'This is text. ',
        'alias' => 'This is alias.',
        'emoji' => ':warning:',
        'avatar' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        // 'tmid' => 'jC9chsFddTvsbFQG7',
        'tshow' => true,
        'attachments' => [
            [
                'title' => 'This is title 1.',
                'title_link' => 'https://rocket.chat',
                'text' => 'This is text 1.',
                'color' => '#BB3E4E',
            ],
        ],
    ])->addAttachment([
        'title' => 'This is title 2.',
        'title_link' => 'https://rocket.chat',
        'text' => 'This is text 2.',
        'image_url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        'color' => '#764FA5',
    ]);

    expect($client)
        ->mock([
            create_response('{"success":true}'),
            create_response('{"success":false,"error":"Invalid integration id or token provided."}'),
        ])
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);
