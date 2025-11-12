<?php

/** @noinspection AnonymousFunctionStaticInspection */
/** @noinspection NullPointerExceptionInspection */
/** @noinspection PhpPossiblePolymorphicInvocationInspection */
/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection StaticClosureCanBeUsedInspection */

declare(strict_types=1);

/**
 * Copyright (c) 2021-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\NotifyTests\ZohoCliq;

use Guanguans\Notify\ZohoCliq\Authenticator;
use Guanguans\Notify\ZohoCliq\Client;
use Guanguans\Notify\ZohoCliq\Messages\Message;

it('can send message', function (): void {
    // $token = Authenticator::generateToken('client-id', 'client-secret');
    $authenticator = new Authenticator('company-id', 'your-channel', 'use $token');
    $client = new Client($authenticator);
    $message = Message::make([
        'text' => 'This is a test message from ZohoCliq integration.',
    ]);

    expect($client)
        ->mock([
            response(faker()->text()),
        ])
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);

it('can send message with bot customization', function (): void {
    // $token = Authenticator::generateToken('client-id', 'client-secret');
    $authenticator = new Authenticator('company-id', 'your-channel', 'use $token');
    $client = new Client($authenticator);
    $message = Message::make([
        'text' => 'Hello from custom bot!',
        'bot' => [
            'name' => 'Custom Bot',
            'image' => 'https://example.com/bot-icon.png',
        ],
    ]);

    expect($client)
        ->mock([
            response(faker()->text()),
        ])
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);

it('can send message with card', function (): void {
    // $token = Authenticator::generateToken('client-id', 'client-secret');
    $authenticator = new Authenticator('company-id', 'your-channel', 'use $token');
    $client = new Client($authenticator);
    $message = Message::make([
        'text' => 'Check out this notification!',
        'card' => [
            'title' => 'Important Update',
            'theme' => 'modern-inline',
            'thumbnail' => 'https://example.com/notification-icon.png',
        ],
        'buttons' => [
            [
                'label' => 'View Details',
                'type' => '+',
                'action' => [
                    'type' => 'open.url',
                    'data' => [
                        'web' => 'https://example.com/details',
                    ],
                ],
            ],
        ],
    ]);

    expect($client)
        ->mock([
            response(faker()->text()),
        ])
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);
