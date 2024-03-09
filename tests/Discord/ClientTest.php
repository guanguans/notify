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

namespace Guanguans\NotifyTests\Discord;

use Guanguans\Notify\Discord\Authenticator;
use Guanguans\Notify\Discord\Client;
use Guanguans\Notify\Discord\Messages\Message;

it('can send message', function (): void {
    $authenticator = new Authenticator('https://discord.com/api/webhooks/1201788029790855200/rsFsK_vmdFLZBqWU3w3En4aVWsekGllzd-mOCby8ymO459G53EBu9FFcIuwCnaXYx');
    $client = new Client($authenticator);
    $message = Message::make([
        'content' => 'This is content.',
        'username' => 'This is username.',
        'avatar_url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        'tts' => true,
        'embeds' => [
            $embed = [
                'title' => 'This is title.',
                'type' => 'rich',
                'description' => 'This is description.',
                'url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
                'timestamp' => '2022-02-24T09:30:00Z',
                'color' => hexdec('0365D6'),
                'footer' => [
                    'text' => 'This is text.',
                    'icon_url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
                    'proxy_icon_url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
                ],
                'image' => [
                    'url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
                    'proxy_url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
                    'height' => 50,
                    'width' => 50,
                ],
                'thumbnail' => [
                    'url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
                    'proxy_url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
                    'height' => 50,
                    'width' => 50,
                ],
                'video' => [
                    'url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
                    'proxy_url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
                    'height' => 50,
                    'width' => 50,
                ],
                'provider' => [
                    'name' => 'This is name.',
                    'url' => 'https://avatars.githubusercontent.com/u/22309277?v=4.',
                ],
                'author' => [
                    'name' => 'This is name.',
                    'url' => 'https://avatars.githubusercontent.com/u/22309277?v=4.',
                    'icon_url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
                    'proxy_icon_url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
                ],
                'fields' => [
                    [
                        'name' => 'This is name.',
                        'value' => 'This is value.',
                        'inline' => false,
                    ],
                ],
            ],
        ],
    ])->addEmbed($embed);

    expect($client)
        ->mock([
            create_response('', 204),
            create_response('{"message": "Invalid Webhook Token", "code": 50027}', 401),
        ])
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);
