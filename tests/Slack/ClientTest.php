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

namespace Guanguans\NotifyTests\Slack;

use Guanguans\Notify\Slack\Authenticator;
use Guanguans\Notify\Slack\Client;
use Guanguans\Notify\Slack\Messages\Message;
use Psr\Http\Message\ResponseInterface;

it('can send message', function (): void {
    $authenticator = new Authenticator('https://hooks.slack.com/services/TPU9A98MT/B038KNUC0GY/6pKH3vfa3mjlUPcgLSjzR');
    $client = new Client($authenticator);
    $message = Message::make([
        'text' => 'This is text.',
        // 'channel' => '#general',
        // 'username' => 'notify bot',
        // 'icon_emoji' => ':ghost:',
        // 'icon_url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        // 'unfurl_links' => true,
        // 'attachments' => $attachment = [
        //    'fallback' => 'Required text summary of the attachment',
        //    'text' => 'Optional text that should appear within the attachment',
        //    'pretext' => 'Optional text that should appear above the formatted data',
        //    'color' => '#36a64f',
        //    'fields' => [
        //        [
        //            'title' => 'Required Field Title',
        //            'value' => 'Text value of the field.',
        //            'short' => false,
        //        ],
        //    ],
        // ],
    ]);

    expect($client)
        ->httpErrors(false)
        ->mock([
            create_response('ok'),
            create_response('invalid_token', 403),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);
