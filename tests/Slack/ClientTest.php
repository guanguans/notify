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

namespace Guanguans\NotifyTests\Slack;

use Guanguans\Notify\Slack\Authenticator;
use Guanguans\Notify\Slack\Client;
use Guanguans\Notify\Slack\Messages\Message;

it('can send message', function (): void {
    $authenticator = new Authenticator('https://hooks.slack.com/services/TPU9A98MT/B038KNUC0GY/6pKH3vfa3mjlUPcgLSjzR');
    $client = new Client($authenticator);
    $message = Message::make([
        'channel' => '#general',
        'attachments' => $attachment = [
            'fallback' => 'This is fallback.',
            'text' => 'This is text.',
            'pretext' => 'This is pretext.',
            'color' => '#36a64f',
            'fields' => [
                [
                    'title' => 'This is title.',
                    'value' => 'This is value.',
                    'short' => false,
                ],
            ],
        ],
        'blocks' => [
            $block = [
                'type' => 'section',
                'text' => [
                    'type' => 'mrkdwn',
                    'text' => 'This is text.',
                ],
            ],
        ],
        'text' => 'This is text.',
        'as_user' => true,
        'icon_emoji' => ':ghost:',
        'icon_url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        'link_names' => true,
        'metadata' => [
            'event_type' => 'task_created',
            'event_payload' => [
                'id' => '11223',
                'title' => 'This is title.',
            ],
        ],
        'mrkdwn' => true,
        'parse' => 'full',
        'reply_broadcast' => true,
        // 'thread_ts' => '1621592155.003100',
        'unfurl_links' => true,
        'unfurl_media' => true,
        'username' => 'This is username.',
    ])
        ->addAttachment($attachment)
        ->addBlock($block);

    expect($client)
        ->mock([
            create_response('ok'),
            create_response('invalid_token', 403),
        ])
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);
