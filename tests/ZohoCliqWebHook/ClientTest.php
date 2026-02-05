<?php

/** @noinspection AnonymousFunctionStaticInspection */
/** @noinspection NullPointerExceptionInspection */
/** @noinspection PhpPossiblePolymorphicInvocationInspection */
/** @noinspection PhpUndefinedClassInspection */
/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection PhpVoidFunctionResultUsedInspection */
/** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

use Guanguans\Notify\ZohoCliqWebHook\Authenticator;
use Guanguans\Notify\ZohoCliqWebHook\Client;
use Guanguans\Notify\ZohoCliqWebHook\Messages\Message;

it('can send message', function (): void {
    $authenticator = new Authenticator(
        'https://cliq.zoho.com/api/v2/channelsbyname/announcements/message?zapikey=1001.4805235707f212af4b11be76483da614.d95141b05ae0550eabe503061a598'
    );
    $client = new Client($authenticator);
    $message = Message::make([
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
    ])
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
        ])
        ->threadMessageId('1599044334698_117280617320')
        ->threadTitle('This is thread title.')
        ->postInParent(true);

    expect($client)
        ->mock([
            response(status: 204),
            response('{"code":"oauthtoken_invalid","message":"Invalid OAuth token passed."}', 401),
        ])
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);
