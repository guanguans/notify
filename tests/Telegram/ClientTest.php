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

namespace Guanguans\NotifyTests\Telegram;

use Guanguans\Notify\Telegram\Authenticator;
use Guanguans\Notify\Telegram\Client;
use Guanguans\Notify\Telegram\Messages\TextMessage;
use Psr\Http\Message\ResponseInterface;

it('can send message', function (): void {
    $authenticator = new Authenticator('6825137102:AAHQvvBpsoJVs-lQSKjZNLELMmpzQ50p');
    $client = new Client($authenticator);
    $message = TextMessage::make([
        'chat_id' => 6173634402,
        'text' => '*This is text*',
        'parse_mode' => 'MarkdownV2',
        // 'entities' => [],
        // 'disable_web_page_preview' => true,
        // 'disable_notification' => true,
        // 'protect_content' => true,
        // 'reply_to_message_id' => 5,
        // 'allow_sending_without_reply' => true,
        // 'reply_markup' => [],
    ]);

    expect($client)
        ->httpErrors(false)
        ->mock([
            create_response('{"ok":true,"result":{"message_id":5,"from":{"id":6825137102,"is_bot":true,"first_name":"guanguansbot","username":"guanguand_bot"},"chat":{"id":6173634402,"first_name":"guanguans","type":"private"},"date":1708397315,"text":"This is text","entities":[{"offset":0,"length":12,"type":"bold"}]}}'),
            create_response('{"ok":false,"error_code":401,"description":"Unauthorized"}', 401),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);
