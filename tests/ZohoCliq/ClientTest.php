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

use Guanguans\Notify\Foundation\Caches\MemoryCache;
use Guanguans\Notify\Foundation\Caches\NullCache;
use Guanguans\Notify\Foundation\Exceptions\InvalidArgumentException;
use Guanguans\Notify\Foundation\Exceptions\RequestException;
use Guanguans\Notify\ZohoCliq\Authenticator;
use Guanguans\Notify\ZohoCliq\Client;
use Guanguans\Notify\ZohoCliq\DataCenter;
use Guanguans\Notify\ZohoCliq\Messages\BotMessage;
use Guanguans\Notify\ZohoCliq\Messages\ChannelMessage;
use Guanguans\Notify\ZohoCliq\Messages\ChatMessage;
use Guanguans\Notify\ZohoCliq\Messages\UserMessage;

beforeEach(function (): void {
    $authenticator = new Authenticator(
        clientId: '1000.TTFROV098VVFG8NB686LR98TCDR',
        clientSecret: 'ffddfbd23c86a677e024003b4b8b8b7f2371ac6',
        // dataCenter: DataCenter::US,
        // cache: new MemoryCache,
        cache: new NullCache,
        client: (new \Guanguans\Notify\Foundation\Client)->mock(array_pad(
            [],
            6,
            response(
                <<<'JSON'
                    {
                        "access_token": "1000.86e0701b6f279bfad7b6a05352dc304d.3106ea5d20401799c010212da3da1",
                        "scope": "ZohoCliq.Webhooks.CREATE",
                        "api_domain": "https://www.zohoapis.com",
                        "token_type": "Bearer",
                        "expires_in": 3600
                    }
                    JSON
            )
        ))
    );
    $this->client = (new Client($authenticator))->mock([
        // response('{"code":"oauthtoken_invalid","message":"Invalid OAuth token passed."}', 401),
        response(
            <<<'JSON_WRAP'
                {"code":"extra_key_found","message":"'content' is an extra key in the JSON Object."}
                JSON_WRAP,
            400
        ),
        response(status: 204),
    ]);
    $this->message = [
        // 'channel_unique_name' => 'announcements',
        // 'bot_unique_name' => 'botname',
        // 'chat_id' => 'CT_2242272070192345152_905914233-B1',
        // 'email_id' => fake()->email(),
        'text' => 'This is text.',
        'bot' => [
            'name' => 'This is bot name.',
            'image' => 'https://www.zoho.com/cliq/help/restapi/images/bot-custom.png',
        ],
        'card' => [
            'title' => 'This is card title.',
            'theme' => 'modern-inline',
            'thumbnail' => 'https://www.zoho.com/cliq/help/restapi/images/announce_icon.png',
        ],
        'slides' => [
            [
                'type' => 'table',
                'title' => 'This is slide table title.',
                'data' => [
                    'headers' => [
                        'Name',
                        'Team',
                        'Reporting To',
                    ],
                    'rows' => [
                        [
                            'Name' => 'Paula Rojas',
                            'Team' => 'Zylker-Sales',
                            'Reporting To' => 'Li Jung',
                        ],
                        [
                            'Name' => 'Quinn Rivers',
                            'Team' => 'Zylker-Marketing',
                            'Reporting To' => 'Patricia James',
                        ],
                    ],
                ],
            ],
        ],
        'buttons' => [
            [
                'label' => 'View button',
                'type' => '+',
                'action' => [
                    'type' => 'invoke.function',
                    'data' => [
                        'name' => 'internlist',
                    ],
                ],
            ],
        ],
    ];
});

it('can send bot message', function (): void {
    $botMessage = BotMessage::make($this->message)
        ->botUniqueName('botname')
        ->addSlide([
            'type' => 'list',
            'title' => 'This is slide list title.',
            'data' => [
                'Time - Tracking for Tasks',
                'Prioritize requirements effectively',
                'Identify and work on a fix for bugs instantly',
            ],
        ])
        ->addButton([
            'label' => 'Cancel button',
            'type' => '-',
            'action' => [
                'type' => 'invoke.function',
                'data' => [
                    'name' => 'internlist',
                ],
            ],
        ]);

    expect($this->client)->assertCanSendMessage($botMessage);
})->group(__DIR__, __FILE__);

it('can send channel message', function (): void {
    $channelMessage = ChannelMessage::make($this->message)->channelUniqueName('announcements');

    expect($this->client)->assertCanSendMessage($channelMessage);
})->group(__DIR__, __FILE__);

it('can send chat message', function (): void {
    $chatMessage = ChatMessage::make($this->message)->chatId('CT_2242272070192345152_905914233-B1');

    expect($this->client)->assertCanSendMessage($chatMessage);
})->group(__DIR__, __FILE__);

it('can send user message', function (): void {
    $userMessage = UserMessage::make($this->message)->emailId(fake()->email());

    expect($this->client)->assertCanSendMessage($userMessage);
})->group(__DIR__, __FILE__);

it('can retry send user message', function (): void {
    /** @var \Guanguans\Notify\Foundation\Response $response */
    $message = UserMessage::make($this->message)->emailId(fake()->email());
    $response = $this
        ->client
        ->mock([
            response('retries0', 401),
            response('retries1', 401),
            response('retries2', 401),
            response(status: 204),
        ])->send($message);
    expect($response)
        ->body()->toBe('retries1')
        ->status()->toBe(401);

    $response = $this
        ->client
        ->mock([
            response('retries0', 400),
            response('retries1', 401),
            response(status: 204),
        ])->send($message);
    expect($response)
        ->body()->toBe('retries0')
        ->status()->toBe(400);

    $response = $this
        ->client
        ->mock([
            response('retries0', 200),
            response('retries1', 401),
            response(status: 204),
        ])->send($message);
    expect($response)
        ->body()->toBe('retries0')
        ->status()->toBe(200);

    $response = $this
        ->client
        ->mock([
            response('retries0', 401),
            response(status: 204),
        ])->send($message);
    expect($response)
        ->body()->toBeEmpty()
        ->status()->toBe(204);
})->group(__DIR__, __FILE__);

it('can throw InvalidArgumentException when data center is invalid', function (): void {
    new DataCenter('invalid_data_center');
})->group(__DIR__, __FILE__)->throws(InvalidArgumentException::class);

it('can get token from cache', function (): void {
    $authenticator = new Authenticator(
        clientId: '1000.TTFROV098VVFG8NB686LR98TCDR',
        clientSecret: 'ffddfbd23c86a677e024003b4b8b8b7f2371ac6',
        cache: new MemoryCache,
        client: (new \Guanguans\Notify\Foundation\Client)->mock([
            response(
                <<<'JSON'
                    {
                        "access_token": "1000.86e0701b6f279bfad7b6a05352dc304d.3106ea5d20401799c010212da3da1",
                        "scope": "ZohoCliq.Webhooks.CREATE",
                        "api_domain": "https://www.zohoapis.com",
                        "token_type": "Bearer",
                        "expires_in": 3600
                    }
                    JSON
            ),
        ])
    );
    expect((string) $authenticator)->toEqual((string) $authenticator);
})->group(__DIR__, __FILE__);

it('can throw RequestException when request failed', function (): void {
    expect((string) new Authenticator(
        clientId: '1000.TTFROV098VVFG8NB686LR98TCDR',
        clientSecret: 'ffddfbd23c86a677e024003b4b8b8b7f2371ac6',
        cache: new NullCache,
        client: (new \Guanguans\Notify\Foundation\Client)->mock([
            response(
                <<<'JSON'
                    {"error":"invalid_client_secret"}
                    JSON
            ),
        ])
    ))->toBeString();
})->group(__DIR__, __FILE__)->throws(RequestException::class);
