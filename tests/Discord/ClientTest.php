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

namespace Guanguans\NotifyTests\Discord;

use Guanguans\Notify\Discord\Authenticator;
use Guanguans\Notify\Discord\Client;
use Guanguans\Notify\Discord\Messages\Message;
use Psr\Http\Message\ResponseInterface;

it('can send message', function (): void {
    $authenticator = new Authenticator('https://discord.com/api/webhooks/1201788029790855200/rsFsK_vmdFLZBqWU3w3En4aVWsekGllzd-mOCby8ymO459G53EBu9FFcIuwCnaXYx');
    $client = new Client($authenticator);
    $message = Message::make([
        'content' => 'This is content.',
        // 'username' => 'notify bot.',
        // 'avatar_url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        // 'tts' => false,
        // 'embeds' => $embed = [
        //     'title' => 'This is title.',
        //     'type' => 'This is type.',
        //     'description' => 'This is description.',
        //     'url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        //     'color' => '0365D6',
        //     'footer' => [
        //         'text' => 'This is text.',
        //         'icon_url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        //     ],
        //     'image' => [
        //         'url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        //     ],
        //     'thumbnail' => [
        //         'url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        //     ],
        //     'author' => [
        //         'name' => 'This is name.',
        //         'url' => 'https://avatars.githubusercontent.com/u/22309277?v=4.',
        //         'icon_url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        //     ],
        //     'fields' => [
        //         [
        //             'name' => 'This is name.',
        //             'value' => 'This is value.',
        //             'inline' => false,
        //         ],
        //     ],
        // ],
    ]);

    expect($client)
        ->httpErrors(false)
        ->mock([
            create_response('', 204),
            create_response('{"message": "Invalid Webhook Token", "code": 50027}', 401),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);
